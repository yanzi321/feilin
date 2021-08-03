<?php

namespace App\Http\RequestsV2;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        return [
//        	'password' => 'required|min:6',
            // 'identity' => 'required',
            // 'name' => 'required',
            // 'credit_code' => 'required',
            // 'legal_tel' => 'required',
            // 'legal_person' => 'required',
            // 'legal_idcard' => 'required',
            // 'public_accunt' => 'required',
            // 'open_bank' => 'required',
            // 'open_bank_add' => 'required',
            // 'bank_branch' => 'required',
        ];
    }
    // public function messages(){
    //     return [
    //         'identity.required' => '企业身份必填',
    //         'name.required' => '企业名称必填',
    //         'credit_code.required' => '统一社会信用代码必填',
    //         'legal_tel.required' => '法人代表电话必填',
    //         'legal_person.required' => '法人代表必填',
    //         'legal_idcard.required' => '法定代表人身份证必填',
    //         'public_accunt.required' => '对公账号必填',
    //         'open_bank.required' => '开户行名称必填',
    //         'open_bank_add.required' => '开户支行所在地必填',
    //         'bank_branch.required' => '开户支行名称必填',
    //     ];
    // }
}
