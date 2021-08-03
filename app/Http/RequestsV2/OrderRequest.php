<?php

namespace App\Http\RequestsV2;

class OrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
        	'business_id' => 'required',
            'agent_id' => 'required',
            'agent_mobile' => 'required',
            'agent_email' => 'required',
            'contract_no' => 'required',
            //规则后面再加
        ];
    }
    public function messages(){
        return [
            'business_id.required' => '卖方身份必填',
            'agent_id.required' => '经办人必填',
            'agent_mobile.required' => '经办人电话必填',
            'agent_email.required' => '经办人邮箱必填',
            'contract_no.required' => '贸易合同必填',
            // 规则没有加全
           
        ];
    }
}
