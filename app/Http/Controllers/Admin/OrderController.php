<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

// $order
// $orders
// Order
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
        $orders = $this->service->collection($request->all());

        return $orders;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
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

        $data = new \App\Http\Resources\Order($order);

        return $this->success($data);
    }

    /**
     * 订单详情
     */
    public function detail($id)
    {
        $detail = $this->service->detail($id);

        return $this->success($detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Order $order)
    {
        if ($this->service->update($order, $request->all())) {
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
    public function destroy(Order $order)
    {
        if ($order->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
