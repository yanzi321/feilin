<?php

namespace App\Http\Middleware;

use App\Exceptions\ErrorException;
use App\Services\MiniJwtService;
use App\User;
use App\WechatUser;
use Closure;
use App\Traits\ApiResponse;

class MiniBind
{
    use ApiResponse;

    public function handle($request, Closure $next)
    {
        if (empty($jwt = $request->header('authorization'))) {
            return $this->error('miss authorization');
        }

        $info = MiniJwtService::getInstance()->decodeJwtToken($jwt);
        if (empty($info)) {
            return $this->error('invalid token');
        }

        /**
         * @var User $user
         */
        $user = User::where('openid', $info->openid)->first();
        if (empty($user)) {
            throw new ErrorException('请先绑定安唯账号');
        }

        session(["openid" => $info->openid]);
        session(["user" => $user]);

        return $next($request);
    }
}
