<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Models\Basic\OrderApproval;
use App\Models\Basic\Order;
use DB;

class OrderApprovalService
{

    public function collection($params)
    {

        $order_id = $params['order_id'] ?? 0;

        $info = OrderApproval::with('businessInfo','orderInfo')->where(['order_id'=>$order_id])
            
            ->orderBy('id','desc')
            ->get();

//        $info = new OrderCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }
        $order=Order::find($data['order_id']);
        $ordermonet=OrderApproval::where([
            ['order_id', '=', $data['order_id']]])
                ->sum('amount_this');
        $examinemoney=$ordermonet+$data['amount_this'];
       if ($examinemoney>$order->money) {
           return false;
       }
        $info = OrderApproval::create($data);

        return $info;
    }

    public function update(OrderApproval $model, $data)
    {
        $order=Order::find($data['order_id']);
        $ordermonet=OrderApproval::where([
            ['order_id', '=', $data['order_id'],'id', '!=', $data['id']]])
                ->sum('amount_this');
        $examinemoney=$ordermonet+$data['amount_this'];
       if ($examinemoney>$order->money) {
           return false;
       }
        return $model->update($data);
    }

    public function show($id){

        $info = OrderApproval::with('businessInfo','orderInfo.agentInfo')->where(['id'=>$id])->first();

        return $info;
    }
    /**
     * 审核审批
     */
    public function examinApproval($user,$data,$id){
        $role=$user->roles->toArray();
        foreach ($role as $key => $value) {
            $role_name=$value['display_name'];
        }
        switch ($role_name) {
            case '风控':
                if ($data['state']=='0') {
                    //客户经理驳回
                    $status='1';
                    $examine_status='0';
                    $operation='驳回了审批';
                }elseif ($data['state']=='1') {
                    $status='1';
                    $examine_status='1';
                    $operation='同意了审批';
                    //客户经理同意
                }else{
                    $status='1';
                    $examine_status='1';
                    $operation='同意了审批';
                    //同意向上提交
                }
                break;
            case '总经理':
                if ($data['state']=='0') {
                    //客户经理驳回
                    $status='1';
                    $examine_status='0';
                    $operation='驳回了审批';
                }elseif ($data['state']=='1') {
                    $status='2';//总经理通过,业务审核结束
                    $examine_status='2';
                    $operation='同意了审批';
                    //客户经理同意
                }else{
                    $status='1';
                    $examine_status='2';
                    //总经理通过,向上提交，风控总监查询，当状态为examine_status2的时候，风控总监是需要审核的
                    $operation='同意了审批';
                    //同意向上提交
                }
                break;
            case '风控总监':
                if ($data['state']=='0') {
                    //客户经理驳回
                    $status='1';
                    $examine_status='0';
                    $operation='驳回了审批';
                }elseif ($data['state']=='1') {
                    $status='1';
                    $examine_status='3';
                    //风控总监通过,总裁查询，当状态为examine_status=3的时候，总裁是需要审核的
                    $operation='同意了审批';
                    //客户经理同意
                }
                break;
            case '总裁':
                if ($data['state']=='0') {
                    //客户经理驳回
                    $status='1';
                    $examine_status='0';
                    $operation='驳回了审批';
                }elseif ($data['state']=='1') {
                    $status='2';
                    $examine_status='4';
                    $operation='同意了审批';
                    //客户经理同意
                }
                break;
            default:
                $status='2';
                $examine_status='1';
                $operation='同意了审批';
                break;
        }
        //查询订单的总金额是否已经达到最大值，
        //如果的查到的审核完成之后，总值达到总金额，那么订单状态到放款中状态
        $orderapproval=OrderApproval::find($id);
        $order=Order::find($orderapproval->order_id);
        // dd($order);
        $ordermonet=OrderApproval::where([
            ['order_id', '=', $orderapproval->order_id],
            ['status', '=', '2']])
                ->sum('amount_this');
        $examinemoney=$ordermonet+$orderapproval->amount_this;
       if ($examinemoney<$order->money) {
           $ordersave['examine_status']='8';
       }else{
            $ordersave['status']='5';
            $ordersave['examine_status']='9';
       }
         DB::beginTransaction();
        try {
            $orderappdata['status']=$status;
            $orderappdata['examine_status']=$examine_status;
            //查询订单的总金额是否已经达到最大值，
            //如果的查到的审核完成之后，总值达到总金额，那么订单状态到放款中状态
            
            $infoapp = $orderapproval->update($orderappdata);
            if ($status=='2') {
                $info = $order->update($ordersave);
            }
            //审批结束之后再添加日志
            if ($ordersave['status']) {
                $order_logs = new OrderLogs();
                $order_logs->insert([
                    'order_id' => $order->id,
                    'type' => '2',
                    'operation_id' => $user->id,
                    'operation_role' => $role_name,
                    'operation_name' => $user->name,
                    'operation' => '审批审核通过',
                    'old_data' => '',
                    'new_data' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // dd($info->status);
            //添加订单日志
            
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }
    /**
     * 放款证明
     * 
     */
    public function loan($user,$data,$id){
        $role=$user->roles->toArray();
        foreach ($role as $key => $value) {
            $role_name=$value['display_name'];
        }
        //查询订单的总金额是否已经达到最大值，
        //如果的查到的审核完成之后，总值达到总金额，那么订单状态到完成状态
        $orderapproval=OrderApproval::find($id);
        $order=Order::find($orderapproval->order_id);
        // dd($order);
        $ordermonet=OrderApproval::where([
            ['order_id', '=', $orderapproval->order_id],
            ['status', '=', '3']])
                ->sum('amount_this');
        $examinemoney=$ordermonet+$orderapproval->amount_this;
       
         DB::beginTransaction();
        try {
            $orderappdata['status']='3';
            $orderappdata['examine_status']='5';
            $orderappdata['loan_pics']=$data['pics'];
            //查询订单的总金额是否已经达到最大值，
            
            $infoapp = $orderapproval->update($orderappdata);
            if (!($examinemoney<$order->money)) {
                $ordersave['status']='6';
                $ordersave['examine_status']='10';
                $info = $order->update($ordersave);
                $order_logs = new OrderLogs();
                $order_logs->insert([
                    'order_id' => $order->id,
                    'type' => '2',
                    'operation_id' => $user->id,
                    'operation_role' => $role_name,
                    'operation_name' => $user->name,
                    'operation' => '放款完成',
                    'old_data' => '',
                    'new_data' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            // dd($info->status);
            //添加订单日志
            // $agent = Agent::find($order->agent_id);
            // // dump($agent);die;
            
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }
}
