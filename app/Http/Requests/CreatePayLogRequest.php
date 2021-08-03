<?php

namespace App\Http\Requests;

// PayLog

class CreatePayLogRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paid_fee' => 'required',
        ];
    }
}
