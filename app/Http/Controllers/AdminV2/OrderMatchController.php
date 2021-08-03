<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Basic\Business;
// use App\ServicesV2\OrderMatchService;
use App\ServicesV2\OrderMatchService;
use Illuminate\Http\Request;


class OrderMatchController extends BaseController
{
    protected $service;

    public function __construct(OrderMatchService $service)
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
    public function store($id,Request $request)
    {
        if ($this->service->store($id,$request->all())) {
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
    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    

     public function destroy($id){
        if ($this->service->delete($id)) {
            return $this->success();
        }

        return $this->error();
    }
    //撮合列表
    public function match(Request $request){
        $data=$request->all();
        $business = $this->service->collectionBus($request->all());
        
        return $this->success($business);

    }
}
