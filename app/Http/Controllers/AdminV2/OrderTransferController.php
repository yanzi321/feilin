<?php


namespace App\Http\Controllers\AdminV2;


use App\ServicesV2\OrderTransferService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\RequestsV2\OrderTransferRequest;
use App\Models\Basic\OrderTransfer;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class OrderTransferController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(OrderTransferService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    public function index(Request $request)
    {
        $orders = $this->service->collection($request->all(),'1');

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
    public function show(OrderTransfer $orderTransfer)
    {
        if (!$orderTransfer) {
            return $this->error();
        }
        // dd($order->id);
        $data=$this->service->show($order->id);
        // $data = new \App\Http\Resources\Order($order);

        return $this->success($data);
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
    public function update(OrderTransferRequest $request, OrderTransfer $orderTransfer)
    {   
        if ($this->service->update($orderTransfer,$request->all())) {
            return $this->success();
        }

        return $this->error();
    }
    public function destroy(OrderTransfer $orderTransfer){

        if ($orderTransfer->delete()) {
            return $this->success();
        }

        return $this->error();
    }



}
