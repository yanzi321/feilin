<?php

namespace App\Http\Middleware;

use App\Services\UserJwtService;
use Closure;
use App\Traits\ApiResponse;

class SmsLogin
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        if (empty($jwt = $request->header('authorization'))) {
            return $this->error('miss authorization header');
        }

        // 判断是否存在
        $info = UserJwtService::getInstance()->decodeJwtToken($jwt);
        if (empty($info)) {
            return $this->error('invalid token');
        }

        session(["info" => $info]);

        return $next($request);
    }
}
