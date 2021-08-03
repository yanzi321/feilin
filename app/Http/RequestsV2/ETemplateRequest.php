<?php

namespace App\Http\RequestsV2;

class ETemplateRequest extends BaseRequest
{
    public function rules()
    {
        $id = substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],"/")+1);
        return [
            'name' => 'required',
            'template_id' => 'required|unique:v2_e_template,template_id,'.$id,
        ];
    }

    public function messages(){
        return [
            'name.required' => '模版名称必填',
            'template_id.required' => '模版id必填',
            'template_id.unique' => '模版id已存在',
        ];
    }
}
