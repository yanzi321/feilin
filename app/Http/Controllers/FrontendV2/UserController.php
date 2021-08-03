<?php


namespace App\Http\Controllers\FrontendV2;


use App\Http\RequestsV2\UserRequest;
use App\ServicesV2\UserService;
use App\Models\Event\Basic;
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
    public function update(Request $request,Business $business)
    {
        $data=$request->all();
        $data['id']=$request->info->id;
        if ($this->service->updateBusiness($business,$data)) {
            return $this->success();
        }

        return $this->error();
    }
    /**
     * 修改主要联系人
     */
    public function updateMastContant(Request $request,Business $business){
        $data=$request->all();
        $data['id']=$request->info->id;
        //判断手机验证码是否正确
        $query = Basic::checkSms($data['mobile'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }
        if ($this->service->updateMast($business,$data)) {
            return $this->success();
        }

        return $this->error();

    }
    /**
     * 添加次要联系人
     */
    public function toocontacts(Request $request){
        $data=$request->all();
        $data['business_id']=$request->info->id;
        if ($this->service->toocontacts($data)) {
            return $this->success();
        }

        return $this->error();

    }
    /**
     * 公司个人信息
     */
    public function detail(Request $request){
        $business = $this->service->show($request->info->id);

        return $business;

    }
    public function updateContant($id,Request $request){

        if ($this->service->updateContant($id,$request->all())) {
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
    /**
     * 修改密码
     */
    public function editPassword(Request $request){
        $this->validate($request, [
            'code' => 'required',
            'contact_tel' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required',
        ], [
            'contact_tel.required' => '手机号必填',
            'contact_tel.regex' => '手机号格式错误',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        // dump($data);
        if ($data['password'] != $data['password_too']) {
            return $this->error('两次密码不一致');
        }
        //判断手机验证码是否正确
        $query = Basic::checkSms($data['contact_tel'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }
        $data['business_id']=$request->info->id;
        // dd($data);
        if ($this->service->editPassword($data)) {
            return $this->success();
        }
        return $this->error();

    }
    public function forgetPassword(Request $request){
        $this->validate($request, [
            'account' => 'required',
            'code' => 'required',
            'contact_tel' => 'required|regex:/^1[3456789]\d{9}$/',
            'password' => 'required',
        ], [
            'contact_tel.required' => '手机号必填',
            'contact_tel.regex' => '手机号格式错误',
            'password.required' => '密码必填',
        ]);
        $data=$request->all();
        // dump($data);
        if ($data['password'] != $data['password_too']) {
            return $this->error('两次密码不一致');
        }
        //判断手机验证码是否正确
        $query = Basic::checkSms($data['contact_tel'],$data['code']);

        if($query['code'] != 1){
            return $this->error($query['message']);
        }
        $business=Business::where(['contact_tel'=>$data['contact_tel'],'account'=>$data['account']])->first();
        if (!$business) {
            return $this->error('联系人或账号不正确');
        }
        //修改密码
        $save['password']=bcrypt($data['password']);
        $res=Business::where(['id'=>$business->id])->update($save);
        if ($res) {
            return $this->success();
        }
        return $this->error();

    }

}
