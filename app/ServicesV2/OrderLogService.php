<?php

namespace App\ServicesV2;

use App\Models\Basic\OrderLogs;
use App\Exceptions\ErrorException;
use App\Models\Basic\Order;
use App\Models\Basic\User;

// CommissionLog
// 业务记录
//  $commission_log
// $commission_logs

class OrderLogService 
{
  

    public function addOrderLogs(Order $order,$user,$logs,$operation='')
    {
        foreach ($logs as $key => $value) {
            $this->addlog($order,$user,$value,$operation);
            // $res=OrderLogs::insert([
            //         'order_id' => $order->id,
            //         'type' => '2',
            //         'operation_id' => $user->id,
            //         'operation_role' => $user->role_name,
            //         'operation_name' => $user->name,
            //         'operation' => $operation,
            //         'field_name' => $value['field_name'],
            //         'old_data' => $value['old_data'],
            //         'new_data' => $value['new_data'],
            //         'created_at' => now(),
            //         'updated_at' => now(),
            //     ]);
            // dump($res);die;
        }
    }
    public function addlog(Order $order,$user,$logs,$operation=''){
        return OrderLogs::insert([
                    'order_id' => $order->id,
                    'type' => '2',
                    'operation_id' => $user->id,
                    'operation_role' => $user->role_name,
                    'operation_name' => $user->name,
                    'operation' => $operation,
                    'field_name' => $logs['field_name'],
                    'old_data' => $logs['old_data'],
                    'new_data' => $logs['new_data'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

    }

}
