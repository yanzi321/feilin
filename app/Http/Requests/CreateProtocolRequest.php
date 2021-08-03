<?php

namespace App\Http\Requests;

class CreateProtocolRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
