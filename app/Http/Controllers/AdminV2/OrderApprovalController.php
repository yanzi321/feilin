<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Basic\Business;
use App\Models\Basic\OrderApproval;
use App\ServicesV2\OrderApprovalService;
use Illuminate\Http\Request;


class OrderApprovalController extends BaseController
{
    protected $service;

    public function __construct(OrderApprovalService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\OrderCollection|\App\Http\Resources\OrderCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = $this->service->collection($request->all());

        return $this->success($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return OrderController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(Request $request)
    {
        $data=$request->all();
        $data['examine_status']='10';
        if ($this->service->store($data)) {
            return $this->success();
        }

        return $this->error('审批金额大于总金额');
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function show(OrderApproval $orderApproval)
    {
        if (!$orderApproval) {
            return $this->error();
        }
        // dd($order->id);
        $data=$this->service->show($orderApproval->id);
        // $data = new \App\Http\Resources\Order($order);

        return $this->success($data);
    }

    // /**
    //  * 审核审批
    //  */
    public function examinApproval($id,Request $request)
    {
        $user = auth('admin')->user();
        $data = $request->all();
        $res=$this->service->examinApproval($user,$data,$id);
        return $this->success($res);
    }
    /**
     * 财务上传放款凭证
     */
    public function loan($id,Request $request){
        $user = auth('admin')->user();
        $data = $request->all();
        $res=$this->service->loan($user,$data,$id);
        return $this->success($res);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, OrderApproval $orderApproval)
    {   
        // $user = auth('admin')->user();
        $data=$request->all();
        $data['examine_status']='10';
        if ($this->service->update($orderApproval,$data)) {
            return $this->success();
        }

        return $this->error('审批金额大于总金额');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order $order
     * @return OrderController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    // public function destroy(Order $order)
    // {
    //     if ($order->delete()) {
    //         return $this->success();
    //     }

    //     return $this->error();
    // }
}
