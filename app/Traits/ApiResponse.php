<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-26
 * Time: 22:29
 */

namespace App\Traits;

trait ApiResponse
{
    public function error($msg = 'error', $code = -1, $statusCode = 200)
    {
        return \response()->json([
            'code' => $code,
            'msg' => $msg
        ], $statusCode)->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($data = '')
    {
        $content = [
            'code' => 200,
            'msg' => 'success',
            'data' => $data
        ];

        if (app('debugbar')->isEnabled()) {
            $debug = ['_debugbar' => app('debugbar')->getData()];
            $content = array_merge($content, $debug);
        }

        return \response()->json($content)->header('Access-Control-Allow-Origin', '*');
    }
}
