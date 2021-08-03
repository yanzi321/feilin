<?php


namespace App\Http\Controllers\FrontendV2;


use App\Http\RequestsV2\OrderRequest;
use App\Models\Basic\Order;
use App\Models\Basic\SmsTemplate;
use App\ServicesV2\OrderService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class OrderController extends BaseController
{
   use ApiResponse;

   protected $service;

   public function __construct(OrderService $service)
   {
       $this->service = $service;
   }

    /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    public function store(Request $request)
    {
        // dd($request->info->id);
        $data=$request->all();
        // $data['business_id']=$request->info->id;
        // if ($this->service->store($data)) {
        //     return $this->success();
        // }
        $res=$this->service->store($data);
            return $this->success($res);


        return $this->error();
    }

    public function update($id,Request $request,Order $order)
    {
        $data=$request->all();
        if ($this->service->editOrder($id,$data,$order)) {
            return $this->success();
        }

        return $this->error();
    }
    /**
     * 提交订单
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function commitorder($id,Request $request){
        $data=$request->all();
        $data['id']=$id;
        $data['status']=1;
        if ($this->service->commOrder($data)) {
            return $this->success();
        }
        return $this->error();

    }
    /**
     * 中南保理公司的列表
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function order(Request $request){
        $data=$request->all();
        $data['business_id']=$data['business_id'] ?? $request->info->id;
        $order= $this->service->collection($data);
        return $this->success($order);
    }
    public function showorder($id){
        $orderdetail= $this->service->show($id);
        return $this->success($orderdetail);
    }
    //删除业务
    public function delete($id){
        if ($this->service->delete($id)) {
            return $this->success();
        }
        return $this->error();

    }

}
