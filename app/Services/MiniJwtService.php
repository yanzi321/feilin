<?php

/**
 * 小程序用的 jwt 服务
 */

namespace App\Services;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class MiniJwtService
{
    const KEY = "avenue_mini_key";
    const EXPIRE_SECONDS = 3600 * 8; // 有效期，8 小时

    public static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new  self();
        }

        return self::$instance;
    }

    public function getJwtToken(string $openid)
    {
        $token = [
            'openid' => $openid,
            'exp' => time() + self::EXPIRE_SECONDS
        ];

        return JWT::encode($token, self::KEY);
    }

    public function decodeJwtToken($jwt)
    {
        // 如果是 Bearer 开头的，记得去除
        if (Str::startsWith('Bearer', $jwt)) {
            $jwt = substr($jwt, 7);
        }

        return JWT::decode($jwt, self::KEY, ['HS256']);
    }
}

