<?php

namespace App\Http\Controllers\Mini;

use App\Services\MiniService;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends BaseController
{
    /**
     * @var MiniService
     */
    protected $miniService;

    public function __construct(MiniService $miniService)
    {
        $this->miniService = $miniService;
    }

    /**
     * 小程序登录哦~
     * @param Request $request
     * @return AuthController|JsonResponse
     */
    public function login(Request $request)
    {
        $code = $request->input('code', '');

        if (empty($code)) {
            return $this->error('请传入 code');
        }

        $info = $this->miniService->login($request->all());

        return $this->success($info);
    }

    /**
     * @param Request $request
     * @return AuthController|bool|JsonResponse
     * @throws ValidationException
     */
    public function bind(Request $request)
    {
        $this->validate($request, [
           'tel' => 'required|tel',
           'password' => 'required|min:6'
        ]);

        list($status, $msg) = UserService::getInstance()->bind($request->all());
        if (!$status) {
            return $this->error($msg);
        }

        return $this->success();
    }
}
