<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-02-28
 * Time: 00:06
 */

namespace App\Services;


abstract class BaseService
{
    public function isSwitchStatus(array $data)
    {
        return isset($data['status']) && count($data) == 1;
    }
}
