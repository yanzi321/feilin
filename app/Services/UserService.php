<?php

namespace App\Services;

use App\User;
use App\Http\Resources\UserCollection;
use App\Exceptions\ErrorException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public static $instance = null;

    /**
     * 获取当前实例啦
     * 其实不一定是单类，只是为了方便使用而已
     * @return UserService|null
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 获取注册用户列表
     * @param null $params
     * @return UserCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';
        $tel = $params['tel'] ?? '';
        $partner_status = $params['partner_status'] ?? null;
        $from = $params['from'] ?? null;
        $from_name = $params['from_name'] ?? null;
        $created_at = $params['created_at'] ?? null;
        $place = $params['place'] ?? null;
        $invite_code = $params['invite_code'] ?? null;

        //  新增字段，用于补充一些特殊场景
        $filter = $params['filter'] ?? 'user';
        $partner_apply_at = $params['partner_apply_at'] ?? null;

        // 2019年07月01日11:33:20 兼容
        if (isset($params['is_partner']) && $params['is_partner']) {
            $filter = 'partner';
        }

        $users = User::orderByDesc('users.id')
            ->with('salesman:id,name')
            ->with('partner:id,name')
            ->with('organization:id,name')
            ->when($filter, function ($query) use ($filter) {
                if ($filter === 'user') {
                    $query->where('partner_status', PartnerService::DEFAULT_STATUS);
                } elseif ($filter === 'partner') {
                    // 大于 0 的，就是非默认用户了，要么是等待审核的，要么是审核通过和失败的
                    $query->where('partner_status', '>', PartnerService::DEFAULT_STATUS);
                }
            })
            ->when($partner_apply_at !== null, function ($query) use ($partner_apply_at) {
                $start_month = Carbon::createFromTimeString($partner_apply_at[0])->startOfMonth();
                $end_month = Carbon::createFromTimeString($partner_apply_at[1])->endOfMonth();
                $query->whereBetween('partner_apply_at', [$start_month, $end_month]);
            })
            ->when($invite_code, function ($query, $invite_code) {
                $query->where('invite_code', 'like', "%$invite_code%");
            })
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%$name%");
            })->when($place, function ($query, $place) {
                $query->where('place', 'like', "%$place%");
            })->when($tel, function ($query, $tel) {
                $query->where('tel', 'like', "%$tel%");
            })->when($partner_status !== null, function ($query) use ($partner_status) {
                $query->where('partner_status', $partner_status);
            })->when($created_at !== null, function ($query) use ($created_at) {
                $start_month = Carbon::createFromTimeString($created_at[0])->startOfMonth();
                $end_month = Carbon::createFromTimeString($created_at[1])->endOfMonth();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })->when($from !== null, function ($query) use ($from, $from_name) {
                switch ($from) {
                    case User::FROM_SALESMAN:
                        $query->whereHas('salesman', function ($q) use ($from_name) {
                            $q->where('name', 'like', "%$from_name%");
                        });
                        break;
                    case User::FROM_PARTNER:
                        $query->whereHas('partner', function ($q) use ($from_name) {
                            $q->where('name', 'like', "%$from_name%");
                        });
                        break;
                    case User::FROM_ORGANIZATION:
                        $query->whereHas('organization', function ($q) use ($from_name) {
                            $q->where('name', 'like', "%$from_name%");
                        });
                        break;
                }

                $query->where('from', $from);
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new UserCollection($users);
    }

    /**
     * 获取注册用户详情
     * @param $id
     * @return UserCollection
     */
    public function resource($id)
    {
        $user = User::find($id);

        return new UserCollection($user);
    }

    /**
     * 新增注册用户
     * @param array $data
     * @return User|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return User::create($data);
    }

    /**
     * 更新注册用户
     * @param User $user
     * @param $data
     * @return bool
     */
    public function update(User $user, $data)
    {
        if (isset($data['password']) && $data['password']) {
            $user->password = Hash::make($data['password']);
        }

        // 如果是修改了审核状态，需要记录时间
        if (isset($data['partner_status']) && $data['partner_status']) {
            $user->partner_approval_at = now();
        }

        return $user->update($data);
    }

    // ----------- 以下为小程序用 ------------ //

    /**
     * 根据 openid 获取用户信息
     * @param string $openid
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function getUserByOpenid(string $openid)
    {
        return User::where('openid', $openid)->first();
    }

    /**
     * 返回绑定状态和原因
     * @param array $data
     * @return array
     */
    public function bind(array $data)
    {
        $tel = $data['tel'];
        $password = $data['password'];

        $user = User::where('tel', $tel)->first();
        if (empty($user)) {
            return [false, '该用户不存在'];
        }

        if (!Hash::check($password, $user->password)) {
            return [false, '密码不正确'];
        }

        $user->openid = session('openid');
        if ($user->save()) {
            return [true, 'success'];
        }

        return [false, '绑定失败'];
    }
}
