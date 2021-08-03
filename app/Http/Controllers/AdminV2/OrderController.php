<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Basic\Business;
use App\Models\Basic\Order;
use App\ServicesV2\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrderController extends BaseController
{
    protected $service;

    public function __construct(OrderService $service)
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
        $status = $request->input('status');
        $status = $request->all();
        $orders = $this->service->collection($request->all(),'0');

        return $this->success($orders);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrderRequest $request
     * @return OrderController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateOrderRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function show(Order $order)
    {
        if (!$order) {
            return $this->error();
        }
        // dd($order->id);
        $data=$this->service->show($order->id);
        // $data = new \App\Http\Resources\Order($order);

        return $this->success($data);
    }
    /**
     * 审核业务
     */
    public function examineOrder($id,Request $request){
        $user = auth('admin')->user();
        $data = $request->all();
        $res=$this->service->examineOrder($user,$data,$id);
        return $this->success($res);

    }
    /**
     * 获取合同编号
     */
    public function genOrderSN($id){
        if (!$id) {
            return $this->error();
        }
        // dd($order->id);
        $sn=$this->service->genOrderSN($id);
        if (!$sn) {
            return $this->error();
        }
            return $this->success($sn);


    }


    // /**
    //  * 订单详情
    //  */
    // public function detail($id)
    // {
    //     $detail = $this->service->detail($id);

    //     return $this->success($detail);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Order $order)
    {   
        $user = auth('admin')->user();
        if ($this->service->update($order,$request->all(),$user)) {
            return $this->success();
        }

        return $this->error();
    }
    /**
     * 获取转让信息
     */
    public function makeOver($id,Request $request){
        $data=$request->all();
        $data['status']='7';
        if ($this->service->makeOver($id,$data)) {
            return $this->success();
        }

        return $this->error();

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
