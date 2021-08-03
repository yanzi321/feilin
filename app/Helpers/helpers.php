<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-27
 * Time: 21:50
 */

if (!function_exists('is_admin_request')) {
    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    function is_admin_request(\Illuminate\Http\Request $request)
    {
        return starts_with($request->getPathInfo(), '/api/admin');
    }
}

if (!function_exists('is_pc_request')) {
    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    function is_pc_request(\Illuminate\Http\Request $request)
    {
        return starts_with($request->getPathInfo(), '/api/pc');
    }
}

if (!function_exists('is_mini_request')) {
    /**
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    function is_mini_request(\Illuminate\Http\Request $request)
    {
        return starts_with($request->getPathInfo(), '/api/mini');
    }
}

if (!function_exists('json_encode_unicode')) {
    /**
     * @param $data
     * @return bool
     */
    function json_encode_unicode($data)
    {
        return \json_encode($data, \JSON_UNESCAPED_UNICODE);
    }
}

if (!function_exists('week_zh')) {
    /**
     * @param $index
     * @return bool
     */
    function week_zh($index)
    {
        $arr = [
            0 => '周日',
            1 => '周一',
            2 => '周二',
            3 => '周三',
            4 => '周四',
            5 => '周五',
            6 => '周六',
        ];

        return $arr[$index];
    }
}
