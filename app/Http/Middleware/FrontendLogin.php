<?php

namespace App\Http\Middleware;

use App\ServicesV2\FrontendJwtService;
use Closure;
use App\Traits\ApiResponse;

class FrontendLogin
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        if (empty($jwt = $request->header('authorization'))) {
            return $this->error('miss authorization');
        }

        // 判断是否存在
        $info = FrontendJwtService::getInstance()->decodeJwtToken($jwt);

        if (empty($info)) {
            return $this->error('invalid token');
        }

        switch ($info){
            case 'Expired token':
                return $this->error('Expired token','401');
                break;
        }

        // 设定 openid
//        session(["legal_tel" => $info->legal_tel]);

        $request->info = $info;

        return $next($request);
    }
}
