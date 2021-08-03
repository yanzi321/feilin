<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Basic\Business;
// use App\Http\RequestsV2\SmsTemplateRequest;
use App\ServicesV2\BusinessService;
use Illuminate\Http\Request;


class BusinessController extends BaseController
{
    protected $service;

    public function __construct(BusinessService $service)
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
    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Order $order
     * @return OrderController|OrderController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Business $business)
    {
        $this->validate($request, [
            'account' => 'required|unique:business,account,'.$business->id,
        ], [
            'account.required' => '账号必填',
        ]);
        if ($this->service->update($business, $request->all())) {
            return $this->success();
        }
        return $this->error();
    }
    public function examineBusiness($id){
        $data['status']='1';
        // dd($business);
        $res=Business::where('id',$id)->update($data);
        if ($res) {
            return $this->success();
        }
        return $this->error();

    }
    /**
     * 添加其他联系人
     */
    public function createContact(Request $request){
        $data=$request->all();
        if ($this->service->toocontacts($data)) {
            return $this->success();
        }

    }
     /**
     * 修改次要联系人
     */
    public function updateContant($id,Request $request){

        if ($this->service->updatecontant($id,$request->all())) {
            return $this->success();
        }

        return $this->error();

    }
     public function delete($id){
        if ($this->service->deletecontant($id)) {
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
    //
    public function addmatch($id,Request $request){

        if ($this->service->addmatch($id,$request->all())) {
            return $this->success();
        }

        return $this->error();

    }
    public function businessIndex(Request $request){
        $orders = $this->service->businessIndex($request->all());

        return $this->success($orders);

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
