<?php

namespace App\Http\Requests;

// Organization

class CreateOrganizationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'content' => 'required',
            'tel' => 'required|tel',
        ];
    }

    public function attributes()
    {
        return [
          'content' => '详情',
        ];
    }
}
