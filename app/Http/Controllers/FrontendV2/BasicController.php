<?php


namespace App\Http\Controllers\FrontendV2;


use App\Models\Basic\SmsCode;
use App\Models\Event\AliyunSms;
use App\Models\Event\Basic;
use Illuminate\Http\Request;

class BasicController extends BaseController
{

    public function sendSms(Request $request){

        $this->validate($request, [
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
        ], [
            'phone.required' => '手机号必填',
            'phone.regex' => '请检查手机号格式',
        ]);

        $code = Basic::getRandomString(6,'0123456789');

        SmsCode::create([
            'phone' => $request->phone,
            'code' => $code,
            'expires' => time() + 5*60,
        ]);

        $sendSms = [
            'phoneNumbers' => $request->phone,
            'templateId' => 1,
            'templateParam' => ["code"=>$code],  // 短信模板中字段的值
        ];

        $query = AliyunSms::sendSms($sendSms);

        if($query['body']['code'] == 'OK'){
            return $this->success();
        }else{
            return $this->error($query['body']['message']);
        }
    }

    public function checkCode(Request $request){
        $this->validate($request, [
            'phone' => 'required|regex:/^1[3456789]\d{9}$/',
            'code' => 'required'
        ], [
            'phone.required' => '手机号必填',
            'phone.regex' => '请检查手机号格式',
            'code.required' => '验证码必填',
        ]);

        $query = Basic::checkSms($request->phone,$request->code);

        if($query['code'] == 1){
            return $this->success($query['message']);
        }else{
            return $this->error($query['message']);
        }

    }

}
