<?php

namespace App\Http\Requests;

class CreatePermission extends BaseRequest
{
    public function rules()
    {
        return [
            'tag' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];
    }
}
