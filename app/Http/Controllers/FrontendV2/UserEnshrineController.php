<?php


namespace App\Http\Controllers\FrontendV2;


use App\ServicesV2\UserService;
use App\ServicesV2\UserEnshrineService;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class UserEnshrineController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(UserEnshrineService $service)
    {
        $this->service = $service;
    }
    /**
     * 我的品类列表
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
    public function store(Request $request)
    {
        // dd($request->info->id);
        $data=$request->all();
        $data['user_id']=$request->info->id;
        if ($this->service->store($data)) {
            return $this->success();
        }
        return $this->error();
    }
    //删除业务
    public function delete($id){
        if ($this->service->delete($id)) {
            return $this->success();
        }
        return $this->error();

    }

}
