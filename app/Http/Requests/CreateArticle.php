<?php

namespace App\Http\Requests;

class CreateArticle extends BaseRequest
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
            'category_id' => 'required|integer',
            'title' => 'required|string',
            'author' => 'required|string',
            'cover' => 'required|url',
            'content' => 'required|string',
            'sort' => 'required|integer',
            'status' => 'required|integer',
        ];
    }
}
