<?php

namespace App\Http\Requests;

// Order

class CreateOrderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'wants_country' => 'required',
            'product_id' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'wants_country' => '留学国家',
            'product_id' => '产品',
        ];
    }
}
