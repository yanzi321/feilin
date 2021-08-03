<?php

/**
 * 短信登录用的 jwt 服务
 */

namespace App\Services;

use Firebase\JWT\JWT;
use Illuminate\Support\Str;

class UserJwtService
{
    const KEY = "avenue_sms_key";
    const EXPIRE_SECONDS = 3600 * 24 * 7; // 有效期，7 days

    public static $instance = null;

    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new  self();
        }

        return self::$instance;
    }

    /**
     * 获取 token
     *
     * @param string $id
     * @param string $type
     * @return string
     */
    public function getJwtToken(string $id, string $type = 'organization')
    {
        $token = [
            'id' => $id,
            'type' => $type,
            'exp' => time() + self::EXPIRE_SECONDS
        ];

        return JWT::encode($token, self::KEY);
    }

    /**
     * 解 token
     *
     * @param $jwt
     * @return object
     */
    public function decodeJwtToken($jwt)
    {
        // 如果是 Bearer 开头的，记得去除
        if (Str::startsWith('Bearer', $jwt)) {
            $jwt = substr($jwt, 7);
        }

        return JWT::decode($jwt, self::KEY, ['HS256']);
    }
}

