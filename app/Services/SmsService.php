<?php

namespace App\Services;

use App\Exceptions\ErrorException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SmsService
{
    const LIMITED_MINS = 2;

    public function send($tel)
    {
        if ($this->isLimited($tel)) {
            throw new ErrorException('请勿重复发送验证码');
        }

        $smsCode = $this->genSmsCode();

        if ($this->requestSendAPI($tel, $smsCode)) {
            Cache::set($this->limitedKey($tel), $smsCode, self::LIMITED_MINS);
        } else {
            throw new ErrorException('网络错误，请重试');
        }

        return true;
    }

    public function requestSendAPI($tel, $smsCode)
    {
        try {
            EasySms::getInstance()->adapter()->send($tel, [
                'template' => 'SMS_176000190',
                'data' => [
                    'code' => $smsCode
                ],
            ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            throw new ErrorException('短信发送失败 [41]');
        }


        return true;
    }

    /**
     * 判断是否受限
     *
     * @param $tel
     * @return bool
     */
    private function isLimited($tel)
    {
        return boolval(
            Cache::get($this->limitedKey($tel))
        );
    }

    /**
     * 获取短信验证码
     *
     * @param $tel
     * @return mixed
     */
    public function getCode($tel)
    {
        return Cache::get($this->limitedKey($tel));
    }

    public function verifyCode($tel, $code)
    {
        return $this->getCode($tel) == $code;
    }

    /**
     * 生成 cache key
     *
     * @param $tel
     * @return string
     */
    private function limitedKey($tel)
    {
        return 'sms' . $tel;
    }

    /**
     * 生成短信验证码
     *
     * @return int
     * @throws \Exception
     */
    private function genSmsCode()
    {
        return random_int(1000, 9999);
    }
}
