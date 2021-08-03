<?php

namespace App\Http\RequestsV2;

class OrderTransferRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }

    public function messages(){
        return [
            'title.required' => '标题必填',
        ];
    }
}
