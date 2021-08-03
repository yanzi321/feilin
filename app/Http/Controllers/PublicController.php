<?php

namespace App\Http\Controllers;

use App\ExternSalesman;
use App\Organization;
use App\Services\SmsService;
use App\Services\UserJwtService;
use Illuminate\Http\Request;

class PublicController extends BaseController
{
    public function sendSms(Request $request)
    {
        $this->validate($request, [
            'tel' => 'required|tel'
        ]);

        $service = new SmsService();
        if ($service->send($request->tel)) {
            return $this->success();
        }

        return $this->error();
    }

    public function smsLogin(Request $request)
    {
        $this->validate($request, [
            'tel' => 'required|tel',
            'code' => 'required'
        ]);

        if (!(new SmsService())->verifyCode($request->tel, $request->code)) {
            return $this->error('验证码错误');
        }

        // 1. 尝试机构登录
        $org = Organization::where('tel', $request->tel)->first();
        if ($org) {
            return $this->success([
                'token' => UserJwtService::getInstance()->getJwtToken($org->id, 'organization'),
                'type' => 'org',
            ]);
        }

        // 2. 机构信息不存在？尝试使用 外部业务员 信息登录
//        $externSalesman = ExternSalesman::where('tel', $request->tel)->first();
//        if ($externSalesman) {
//            return $this->success([
//                'token' => UserJwtService::getInstance()->getJwtToken($externSalesman->id, 'extern_salesman'),
//                'type' => 'extern_salesman',
//            ]);
//        }

        // 3. 都不存在？那就是没得谈咯
        return $this->success('登录信息不存在，请核实手机号码');
    }
}
