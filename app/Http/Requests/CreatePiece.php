<?php

namespace App\Http\Requests;

class CreatePiece extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isSwitchStatus()) {
            return [
                'status' => 'required|integer'
            ];
        }

        return [
            'name' => 'required|string',
            'model_id' => 'required',
            'sort' => 'required|integer',
        ];
    }
}
