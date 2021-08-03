<?php

namespace App\Http\Middleware;

use App\Services\MiniJwtService;
use Closure;
use App\Traits\ApiResponse;

class MiniLogin
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        if (empty($jwt = $request->header('authorization'))) {
            return $this->error('miss authorization');
        }

        // 判断是否存在
        $info = MiniJwtService::getInstance()->decodeJwtToken($jwt);
        if (empty($info)) {
            return $this->error('invalid token');
        }

        // 设定 openid
        session(["openid" => $info->openid]);

        return $next($request);
    }
}
