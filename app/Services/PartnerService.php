<?php

namespace App\Services;

use App\CommissionLog;
use App\Exceptions\ErrorException;
use App\Mail\NewPartnerApply;
use App\Order;
use App\User;
use App\UserCard;
use App\UserCashRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PartnerService
{
    const DEFAULT_STATUS = 0; // 默认
    const PENDING_STATUS = 1; // 待审批
    const SUCCESS_STATUS = 2; // 成功
    const FAILED_STATUS = 3; // 失败

    public static $instance = null;

    /**
     * 获取当前实例啦
     * 其实不一定是单类，只是为了方便使用而已
     * @return PartnerService
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 申请成为合作者
     * @param array $data
     * @return array
     * @throws ErrorException
     */
    public function apply(array $data)
    {
        if (empty($data['name'])) {
            throw new ErrorException('姓名 不能为空');
        }

        // 如果 user_id 为空，需要生成新用户
        if (empty($data['user_id']) && empty(session('user'))) {
            // 如果没有传入 user_id， 但是用户存在
            $user = User::whereOpenid(session('openid'))->first();
            if (!$user) {
                if (User::where('tel', $data['tel'])->count()) {
                    throw new ErrorException('该手机号已存在');
                }

                $user = new User();
                $user->openid = session('openid');
            } else {
                if ($user->tel && ($data['tel'] != $user->tel)) {
                    throw new ErrorException('手机号与后台登录的不一致');
                }
            }
        } else {
            if (empty(session('user'))) {
                $user = User::find($data['user_id']);
            } else {
                $user = session('user');
            }

            if ($user->tel && ($data['tel'] != $user->tel)) {
                throw new ErrorException('手机号与后台登录的不一致');
            }
        }

        if ($user->partner_status == PartnerService::SUCCESS_STATUS) {
            throw new ErrorException('您已是合作者，请勿重复绑定');
        }

        $user->name = $data['name'];
        $user->tel = $data['tel'];
        $user->partner_apply_at = now();
        $user->partner_status = PartnerService::PENDING_STATUS;
        $user->save();

        // 增加 邀请码
        $user->invite_code = $this->generateInviteCode($user);
        $user->save();

        // 发送用户消息啦
        \Mail::to('global_group@steptousa.com')->send(new NewPartnerApply($user));

        return [
            'partner_status' => $user->partner_status,
            'invite_code' => $user->invite_code
        ];
    }

    /**
     * @param $data
     * @param User $user
     * @return UserCard|\Illuminate\Database\Eloquent\Model
     */
    public function addCard($data, $user = null)
    {
        if (empty($user)) {
            $user = session('user');
        }

        $data['user_id'] = $user->id;

        return UserCard::updateOrCreate($data);
    }

    /**
     * @param User $user
     */
    public function getBeforeCashData($user = null)
    {
        if (empty($user)) {
            $user = session('user');
        }

        // 获取银行卡信息
        $cards = UserCard::select(['id', 'card_number', 'branch_name', 'real_name', 'tel'])
            ->where('user_id', $user->id)->orderByDesc('last_used_at')->get();

        return [
            'cards' => $cards->toArray(),
            'total' => $this->getPartnerTotalCommission($user),
            'success' => $this->getPartnerSuccessCommission($user),
            'pending' => $this->getPartnerPendingCommission($user),
            'in_process' => $this->getPartnerInProcessCommission($user),
        ];
    }

    /**
     * 获取用户所有的佣金
     * @param User $user
     * @return mixed
     */
    public function getPartnerTotalCommission(User $user)
    {
        $total = CommissionLog::wherePartnerId($user->id)->sum('commission');
        return $total;
    }

    /**
     * 获取已经提现的佣金
     * @param User $user
     * @return mixed
     */
    public function getPartnerSuccessCommission(User $user)
    {
        return $this->getPartnerStatusCommission($user, UserCashRequest::STATUS_SUCCESS);
    }

    /**
     * 获取正在审核中的
     * @param User $user
     * @return mixed
     */
    public function getPartnerPendingCommission(User $user)
    {
        return $this->getPartnerStatusCommission($user, UserCashRequest::STATUS_PENDING);

    }

    /**
     * 获取正在审核中的
     * @param User $user
     * @return mixed
     */
    public function getPartnerInProcessCommission(User $user)
    {
        return $this->getPartnerStatusCommission($user, UserCashRequest::STATUS_IN_PROCESS);
    }

    /**
     * 获取指定状态的佣金
     * @param User $user
     * @param $status
     * @return mixed
     */
    public function getPartnerStatusCommission(User $user, $status)
    {
        $amount = UserCashRequest::where('user_id', $user->id)
            ->where('status', $status)
            ->sum('cash_amount');

        return $amount;
    }

    /**
     * 获取当前用户的可用提现余额
     * @param User $user
     * @return mixed
     */
    private function getPartnerLeftCommission(User $user)
    {
        $total = $this->getPartnerTotalCommission($user);
        $used = $this->getPartnerSuccessCommission($user);

        return $total - $used;
    }

    /**
     * @param array $data
     * @param User $user
     * @return UserCashRequest|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function cashRequest(array $data, $user = null)
    {
        if (empty($user)) {
            $user = session('user');
        }

        $card = UserCard::where('user_id', $user->id)->where('id', $data['card_id'])->first();
        if (empty($card)) {
            throw new ErrorException('银行卡信息有误');
        }

        // 获取当前可用的提现金额
        $left = $this->getPartnerLeftCommission($user);
        if (empty($left)) {
            throw new ErrorException('当前无可用提现');
        }

        if ($data['amount'] > $left) {
            throw new ErrorException('提现金额有误');
        }

        return UserCashRequest::create([
            'user_id' => $user->id,
            'cash_way' => UserCashRequest::CASH_WAY_BANK,
            'name' => $card->real_name,
            'tel' => $card->tel,
            'bank_name' => $card->bank_name,
            'branch_name' => $card->branch_name,
            'card_number' => $card->card_number,
            'cash_amount' => $data['amount'],
            'status' => UserCashRequest::STATUS_PENDING,
        ]);
    }

    /**
     * @param User $user
     * @return Builder[]|Collection
     */
    public function cashRequestLogs($user = null)
    {
        if (empty($user)) {
            $user = session('user');
        }

        $data = UserCashRequest::where('user_id', $user->id)->orderByDesc('updated_at')->get();

        return $data;
    }

    public function orders($user = null)
    {
        $user = $this->getUser($user);

//        $data = Order::select(['id', 'order_sn', 'user_id', 'product_id', 'admin_id', 'status'])
//            ->where('from', User::FROM_PARTNER)
//            ->where('from_id', $user->id)
//            ->orderBy('status')
//            ->with('admin:id,name')
//            ->with('product:id,name,price')
//            ->get();

        $data = \DB::table('orders')->selectRaw(
            'orders.id as order_id, ' .
            'orders.order_sn as order_sn, ' .
            'orders.status as order_status, ' .

            'products.id as product_id, ' .
            'products.name as product_name, ' .

            '"" as user_nickname, ' .
            '"" as user_avatar, ' .

            'activity_summer_camps.name as user_name, ' .
            'activity_summer_camps.tel as user_tel, ' .

            'admins.id as admin_id, ' .
            'admins.name as admin_name, ' .

            'sum(commission_logs.commission) as commission'
        )->where('orders.from', User::FROM_PARTNER)
            ->where('orders.from_id', $user->id)
//            ->leftJoin('users', function ($join) {
//                $join->on('users.id', '=', 'orders.user_id');
//            })->leftJoin('wechat_users', function ($join) {
//                $join->on('wechat_users.openid', '=', 'users.openid');
//            })
            ->leftJoin('activity_summer_camps', function ($join) {
                $join->on('orders.activity_summer_camp_id', '=', 'activity_summer_camps.id');
            })
            ->leftJoin('products', function ($join) {
                $join->on('orders.product_id', '=', 'products.id');
            })->leftJoin('admins', function ($join) {
                $join->on('orders.admin_id', '=', 'admins.id');
            })->leftJoin('commission_logs', function ($join) {
                $join->on('orders.id', '=', 'commission_logs.order_id');
            })->groupBy('orders.id')->get();

        return $data;
    }

    /**
     * @param null $user
     * @return User
     */
    private function getUser($user = null)
    {
        if (empty($user)) {
            $user = session('user');
        }

        return $user;
    }

    /**
     * 生成邀请码
     * @param User $user
     * @return string
     */
    private function generateInviteCode(User $user)
    {
        $arr1 = str_random(3);
        $arr2 = $user->id;
        $arr3 = str_random(3);

        $invite_code = $arr1 . $arr2 . $arr3;

        return $invite_code;
    }
}
