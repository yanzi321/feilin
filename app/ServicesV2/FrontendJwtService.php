<?php

/**
 * 小程序用的 jwt 服务
 */

namespace App\ServicesV2;

use App\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class FrontendJwtService
{
    const KEY = "avenue_frontend_key";
    const EXPIRE_SECONDS = 3600 * 8; // 有效期，8 小时

    public static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new  self();
        }

        return self::$instance;
    }

    public function getJwtToken($data)
    {
        $token = [
            'legal_tel' => $data['legal_tel'],
            'id' => $data['id'],
            'exp' => time() + self::EXPIRE_SECONDS
        ];

        return JWT::encode($token, self::KEY);
    }

    public function decodeJwtToken($jwt)
    {
//        // 如果是 Bearer 开头的，记得去除
//        if (Str::startsWith('bearer', $jwt)) {
//            $jwt = substr($jwt, 7);
//        }

        // 如果是 Bearer 开头的，记得去除
        $jwt = str_replace('bearer ','',$jwt);
        return JWT::decode($jwt, self::KEY, ['HS256']);
    }
}

