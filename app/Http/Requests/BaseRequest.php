<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    abstract function rules();


    protected function isSwitchStatus()
    {
        return count($this->all()) === 1 && $this->has('status');
    }
}
