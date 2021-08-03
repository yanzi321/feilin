<?php


namespace App\Http\Controllers\FrontendV2;

use App\ServicesV2\FrontendService;
use Illuminate\Http\Request;

class AuthController extends BaseController
{

    protected $frontendService;

    public function __construct(FrontendService $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'mobile' => 'required',
            'password' => 'required',
        ], [
            'mobile.required' => '手机不能为空',
            'password.required' => '密码不能为空',
        ]);

        $info = $this->frontendService->login($request->all());

        if($info['query']){
            return $this->success($info);
        }else{
            return $this->error($info['msg']);
        }
    }


    public function info(Request $request){
       dd($request->info);
    }
}
