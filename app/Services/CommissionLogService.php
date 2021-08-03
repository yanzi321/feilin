<?php

namespace App\Services;

use App\CommissionLog;
use App\CommissionRule;
use App\Http\Resources\CommissionLogCollection;
use App\Http\Resources\CommissionLog as CommissionLogResource;
use App\Exceptions\ErrorException;
use App\Order;
use App\User;

// CommissionLog
// 佣金记录
//  $commission_log
// $commission_logs

class CommissionLogService extends BaseService
{
    /**
     * 获取佣金记录列表
     * @param null $params
     * @return CommissionLogCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $commission_logs = CommissionLog::orderBy('sort')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new CommissionLogCollection($commission_logs);
    }

    /**
     * 获取佣金记录详情
     * @param $id
     * @return CommissionLogCollection
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $commission_log = CommissionLog::find($id);

        return CommissionLogResource::collection($commission_log);
    }

    /**
     * 新增佣金记录
     * @param array $data
     * @return CommissionLog|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return CommissionLog::create($data);
    }

    /**
     * 更新佣金记录
     * @param CommissionLog $commission_log
     * @param $data
     * @return bool
     */
    public function update(CommissionLog $commission_log, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $commission_log->update($data);
        }

        return $commission_log->update($data);
    }

    public function addAnCommissionLog(Order $order)
    {
        // 有些情况是不需要计算的
        if ($this->skipOrderCommission($order)) {
            return true;
        }

        // 这是这个人的第几单呀？
        $partnerOrdersCount = $this->getPartnerOrdersCount($order) + 1;

        /**
         * @var CommissionRule $currentRule
         */
        $currentRule = CommissionRule::where('max_number', '>=', $partnerOrdersCount)
            ->orderBy('stage')->first();

        if (!$currentRule) {
            throw new ErrorException('佣金规则查询失败');
        }

        try {
            \DB::beginTransaction();

            // 额外的奖励哦~
            $extraAmount = $this->getExtraAmount($currentRule, $partnerOrdersCount);
            if ($extraAmount) {
                CommissionLog::insert([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'partner_id' => $order->from_id,
                    'commission' => $extraAmount,
                    'commission_rule_id' => $currentRule->id,
                    'commission_rule_snapshot' => $currentRule->toJson(),
                    'is_extra' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // 保存这次的佣金哦~
            CommissionLog::insert([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'partner_id' => $order->from_id,
                'commission' => $currentRule->commission,
                'commission_rule_id' => $currentRule->id,
                'commission_rule_snapshot' => $currentRule->toJson(),
                'is_extra' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            \DB::commit();

            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw new ErrorException($exception->getMessage());
        }
    }

    /**
     * 如果这一次正好是跨阶段的，需要返还一个差价。
     * @param CommissionRule $currentRule
     * @param $partnerOrdersCount
     * @return float|int
     */
    private function getExtraAmount(CommissionRule $currentRule, $partnerOrdersCount)
    {
        if ($currentRule->stage < 2) {
            return 0;
        }

        /**
         * @var CommissionRule $prevRule
         */
        $prevRule = CommissionRule::where('stage', $currentRule->stage - 1)->first();
        if ($partnerOrdersCount - $prevRule->max_number != 1) {
            return 0;
        }

        // 如果这次的人头数，正好是上一阶段+1，意味着需要计算差价啦
        $diffAmount = $currentRule->commission - $prevRule->commission;

        // 算出相差的人数
        if ($prevRule->stage < 2) {
            $prevCount = $prevRule->max_number;
        } else {
            /**
             * @var CommissionRule $prevPrevRule
             */
            $prevPrevRule = CommissionRule::where('stage', $prevRule->stage - 1)->first();
            $prevCount = $prevRule->max_number - $prevPrevRule->max_number;
        }

        return $diffAmount * $prevCount;
    }

    // 是否需要跳过计算
    private function skipOrderCommission(Order $order)
    {
        // 状态不对，跳过
        if ($order->status != Order::SERVICE_SUCCESS_STATUS) {
            return true;
        }

        // 已经添加了，跳过
        if ($this->hasAdded($order)) {
            return true;
        }

        // 不是来自合作者的，跳过
        if (!$this->isFromPartner($order)) {
            return true;
        }

        return false;
    }

    /**
     * 看下当前的订单是不是计算过，计算过就不需要再添加啦
     * @param Order $order
     * @return int
     */
    private function hasAdded(Order $order)
    {
        return CommissionLog::where('order_id', $order->id)->count();
    }

    /**
     * 这个订单时来自合作者？
     * @param Order $order
     * @return bool
     */
    private function isFromPartner(Order $order)
    {
        return $order->from == User::FROM_PARTNER;
    }

    /**
     * 看下这个订单时这个合作者的成功的第几单
     * @param Order $order
     * @return int
     */
    private function getPartnerOrdersCount(Order $order)
    {
        $partner_id = $order->from_id;
        return Order::where('from', User::FROM_PARTNER)
            ->where('from_id', $partner_id)
            ->where('status', Order::SERVICE_SUCCESS_STATUS)
            ->count();
    }
}
