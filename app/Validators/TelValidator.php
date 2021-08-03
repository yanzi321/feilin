<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-27
 * Time: 20:31
 */

namespace App\Validators;


class TelValidator
{
    /**
     * 验证手机号
     * @param $attribute
     * @param $value
     * @param $parameters
     * @param $validator
     * @return false|int
     */
    public function validate($attribute, $value, $parameters, $validator)
    {
        $regular = "/^[1]([3-9])[0-9]{9}$/";
        return preg_match($regular, $value);
    }
}
