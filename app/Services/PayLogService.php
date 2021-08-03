<?php

namespace App\Services;

use App\Order;
use App\PayLog;
use App\Http\Resources\PayLogCollection;
use App\Http\Resources\PayLog as PayLogResource;
use App\Exceptions\ErrorException;

// PayLog
// 缴费记录
//  $payLog
// $payLogs

class PayLogService extends BaseService
{
    /**
     * 获取缴费记录列表
     * @param null $params
     * @return PayLogCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $payLogs = PayLog::orderBy('sort')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new PayLogCollection($payLogs);
    }

    /**
     * 获取缴费记录详情
     * @param $id
     * @return PayLogCollection
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $payLog = PayLog::find($id);

        return PayLogResource::collection($payLog);
    }

    /**
     * 新增缴费记录
     * @param array $data
     * @return PayLog|bool|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        if (empty($data['paid_at'])) {
            $data['paid_at'] = now();
        }

        $data['admin_id'] = auth('admin')->id();

        \DB::transaction(function () use ($data) {
            // 增加记录
            PayLog::create($data);

            // 更新订单信息
            $order = Order::find($data['order_id']);
            $order->paid_fee = $order->paid_fee + $data['paid_fee'];
            $order->left_fee = $order->total_fee - $order->paid_fee;
            $order->save();
        });

        return true;
    }

    /**
     * 更新缴费记录
     * @param PayLog $payLog
     * @param $data
     * @return bool
     */
    public function update(PayLog $payLog, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $payLog->update($data);
        }

        return $payLog->update($data);
    }
}
