<?php

namespace App\Http\RequestsV2;

class SmsTemplateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'type' => 'required|in:0,1,2,3',
            'name' => 'required|max:30',
            'content' => 'required|max:500',
            'reason' => 'required|max:100',
        ];
    }

    public function messages(){
        return [
            'type.required' => '模版类型必填',
            'type.in' => '模版类型验证码/短信通知/推广短信/国际/港澳台消',
            'name.required' => '模版名称必填',
            'name.max' => '模版名称最多30个字符',
            'content.required' => '模板内容必填',
            'content.max' => '模板内容最多500个字符',
            'reason.required' => '申请说明必填',
            'reason.max' => '申请说明最多100个字符',
        ];
    }
}
