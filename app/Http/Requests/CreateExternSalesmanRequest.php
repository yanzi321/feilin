<?php

namespace App\Http\Requests;

class CreateExternSalesmanRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'tel' => 'required|tel',
        ];
    }
}
