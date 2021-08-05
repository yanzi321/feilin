<?php


namespace App\Http\Controllers\FrontendV2;


use App\Http\RequestsV2\UserRequest;
use App\ServicesV2\UserService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\Basic\User;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class UserController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(UserService $service)
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
        $this->validate($request, [
            'mobile' => 'required|unique:users,mobile',
            // 'password' => 'required|alpha_num|between:6,12|confirmed',
            'password' => 'required',
        ], [
            'mobile.required' => '手机不能为空',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        unset($data['code']);
        $data['password']=bcrypt($data['password']);
        if ($this->service->store($data)) {
            return $this->success();
        }
        return $this->error();
    }
    /**
     * 编辑企业信息
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function update(Request $request,User $user)
    {
        $data=$request->all();
        $data['id']=$request->info->id;
        if ($this->service->update($user,$data)) {
            return $this->success();
        }

        return $this->error();
    }
   
    /**
     * 公司个人信息
     */
    public function detail(Request $request){
        $business = $this->service->show($request->info->id);
        return $this->success($business);

    }
    
    /**
     * 修改密码
     */
    public function editPassword(Request $request){
        $this->validate($request, [
            'password_old' => 'required',
            'mobile' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required',
        ], [
            'mobile.required' => '手机号必填',
            'mobile.regex' => '手机号格式错误',
            'password_old.required' => '原密码必填',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        // dump($data);
        if ($data['password'] != $data['password_too']) {
            return $this->error('两次密码不一致');
        }
        //判断手机验证码是否正确
        /*$query = Basic::checkSms($data['mobile'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }*/
        $data['user_id']=$request->info->id;
        // dd($data);
        if ($this->service->editPassword($data)) {
            return $this->success();
        }
        return $this->error();

    }
    public function forgetPassword(Request $request){
        $this->validate($request, [
            'mobile' => 'required',
            'code' => 'required',
            'mobile' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required',
        ], [
            'mobile.required' => '手机号必填',
            'mobile.regex' => '手机号格式错误',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        // dump($data);
        
        //判断手机验证码是否正确
        $query = Basic::checkSms($data['mobile'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }
        $business=User::where(['mobile'=>$data['mobile']])->first();
        if (!$business) {
            return $this->error('该手机号没有注册');
        }
        //修改密码
        $save['password']=bcrypt($data['password']);
        $res=User::where(['id'=>$business->id])->update($save);
        if ($res) {
            return $this->success();
        }
        return $this->error();

    }
    //修改账号
    public function updateMobile(Request $request){
        $this->validate($request, [
            'code' => 'required',
            'mobile' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required',
        ], [
            'mobile.required' => '手机号必填',
            'mobile.regex' => '手机号格式错误',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        // dump($data);
        //判断手机验证码是否正确
        $query = Basic::checkSms($data['mobile'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }
        $data['user_id']=$request->info->id;
        // dd($data);
        if ($this->service->editPassword($data)) {
            return $this->success();
        }
        return $this->error();
    }
    public function sorceList(Request $request){
        $data=$request->all();
        $data['user_id']=$request->info->id;
        $info=$this->service->sorceList($data);
        return $this->success($info);

    }
    public function gainScore(Request $request){
        $data=$request->all();
        $data['user_id']=$request->info->id;
        if ($this->service->gainScore($data)) {
            return $this->success();
        }
        return $this->error();

    }

}
