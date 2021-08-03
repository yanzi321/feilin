<?php

namespace App\Http\Requests;

class UpdateAdmin extends BaseRequest
{
    public function rules()
    {
        if ($this->isSwitchStatus()) {
            return [
                'status' => 'required|integer'
            ];
        }

        return [
            'name' => 'required|string',
            'password' => 'min:6',
            'status' => 'required|integer',
            'tel' => 'required|tel',
            'email' => 'required|email',
        ];
    }
}
