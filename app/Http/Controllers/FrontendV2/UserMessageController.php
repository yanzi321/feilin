<?php


namespace App\Http\Controllers\FrontendV2;


use App\ServicesV2\UserService;
use App\ServicesV2\UserMessageService;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class UserMessageController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(UserMessageService $service)
    {
        $this->service = $service;
    }
    /**
     * 我的系统消息列表
     *
     * @param      \Illuminate\Http\Request  $request  The request
     */
    public function index(Request $request){
        $data=$request->all();
        $data['user_id']=$data['user_id'] ?? $request->info->id;
        $order= $this->service->collection($data);
        return $this->success($order);
    }

      /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    //删除业务
    public function delete($id){
        if ($this->service->delete($id)) {
            return $this->success();
        }
        return $this->error();

    }
    //详情
    public function show($id){
        $words=$this->service->show($id);
            return $this->success($words);

    }
    /**
     * 一键阅读全部
     */
    public function readSystem(Request $request){
        $data=$request->all();
        $data['user_id']=$data['user_id'] ?? $request->info->id;
        if ($this->service->read_all($data)) {
            return $this->success();
        }
        return $this->error();

    }
}
