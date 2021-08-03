<?php

namespace App\Http\Requests;

class CreateRole extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required'
        ];
    }
}
