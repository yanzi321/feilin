<?php

namespace App\Http\Requests;

// ActivitySummerCamp

class CreateActivitySummerCampRequest extends BaseRequest
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
            'tel' => 'required|tel',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '姓名不能为空'
        ];
    }
}
