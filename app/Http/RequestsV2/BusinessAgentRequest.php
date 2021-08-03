<?php

namespace App\Http\RequestsV2;

class BusinessAgentRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'id_card' => 'required',
            'mobile' => 'required|regex:/^1[3456789]\d{9}$/',
            'email' => 'required|email',
        ];
    }
     public function messages(){
         return [
             'name.required' => '姓名必填',
             'id_card.required' => '身份证必填',
             'mobile.required' => '手机号必填',
             'mobile.regex' => '手机号格式错误',
             'email.required' => '邮箱必填',
             'email.email' => '邮箱格式错误',
         ];
     }
}
