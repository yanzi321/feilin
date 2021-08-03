<?php

namespace App\Http\Requests;

class CreateAdmin extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'password' => 'required|min:6',
            'status' => 'required|integer',
            'tel' => 'required|tel|unique:admins',
            'email' => 'required|email|unique:admins',
        ];
    }
}
