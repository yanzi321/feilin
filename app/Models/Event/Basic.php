<?php


namespace App\Models\Event;


use App\Models\Basic\SmsCode;

class Basic
{

    public static function getRandomString($len, $chars=null)
    {
        if (is_null($chars)) {
            $chars = "abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ0123456789";
        }
        mt_srand(10000000*(double)microtime());
        for ($i = 0, $str = '', $lc = strlen($chars)-1; $i < $len; $i++) {
            $str .= $chars[mt_rand(0, $lc)];
        }
        return $str;
    }

    public static function checkSms($phone,$code){

        $model = SmsCode::where(['phone'=>$phone])->orderBy('id','desc')->first();

        if($model == NULL){
            return ['code'=>'-1','message'=>'未发送验证码'];
        }

        if($model->expires < time()){
            return ['code'=>'-1','message'=>'验证码已过期，请重新获取'];
        }

        if($model->code != $code){
            return ['code'=>'-1','message'=>'请输入正确的验证码'];
        }

        SmsCode::where(['phone'=>$phone])->delete();

        return ['code'=>'1','message'=>'验证成功'];
    }
}
