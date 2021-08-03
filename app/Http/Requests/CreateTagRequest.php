<?php

namespace App\Http\Requests;

class CreateTagRequest extends BaseRequest
{
    public function rules()
    {
        if ($this->isSwitchStatus()) {
            return [
                'status' => 'required|integer'
            ];
        }

        return [
            'name' => 'required',
            'sort' => 'required|integer',
        ];
    }
}
