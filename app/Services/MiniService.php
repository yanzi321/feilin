<?php

namespace App\Services;

use App\Exceptions\ErrorException;
use App\User;
use App\WechatUser;
use Illuminate\Support\Facades\Storage;

class MiniService
{
    protected $app;

    public function __construct()
    {
        $this->app = \EasyWeChat::miniProgram();
    }

    /**
     * @param string $code
     * @return array
     * @throws ErrorException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function login(array $data)
    {
        $code = $data['code'];

        // 如果 mock
        if (config('wechat.mock_appid')) {
            $info['openid'] = config('wechat.mock_appid');
        } else {
            $info = $this->app->auth->session($code);
        }

        if (!isset($info['openid'])) {
            throw new ErrorException(\json_encode($info));
        }

        /**
         * @var WechatUser $wechat_user
         */
        $wechat_user = WechatUser::firstOrNew(['openid' => $info['openid']]);
        $wechat_user->nickname = $data['nickname'];
        $wechat_user->avatar = $data['avatar'];
        $wechat_user->save();

        /**
         * @var User $user
         */
        $user = UserService::getInstance()->getUserByOpenid($info['openid']);
        if ($user) {
            $user->avatar = $data['avatar'];
            $user->nickname = $data['nickname'];
            $user->save();
        }

        return [
            'is_bind' => $user ? true : false,
            'is_partner' => $user ? $user->partner_status : 0,
            'invite_code' => $user ? $user->invite_code : null,
            'user_id' => $user ? $user->id : null,
            'tel' => $user ? $user->tel : null,
            'token' => MiniJwtService::getInstance()->getJwtToken($info['openid'])
        ];
    }

    public function wxacode($path, $scene, $with = 600)
    {
        $response = $this->app->app_code->getUnlimit($scene, [
            'page' => $path,
            'width' => 600
        ]);

        if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
            $storagePath = Storage::disk('public')->path('appcode');

            $filename = $response->save($storagePath, md5($path . $scene . $with));

            return asset("storage/appcode/${filename}");
        } else {
            throw new ErrorException('error');
        }
    }
}
