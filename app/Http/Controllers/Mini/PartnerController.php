<?php

namespace App\Http\Controllers\Mini;

use App\Services\MiniService;
use App\Services\PartnerService;
use App\Services\UserService;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PartnerController extends BaseController
{
    protected $service;

    public function __construct(PartnerService $partnerService)
    {
        $this->service = $partnerService;
    }

    /**
     * 成为合作者
     * @param Request $request
     * @return PartnerController|JsonResponse
     * @throws ValidationException
     * @throws \App\Exceptions\ErrorException
     */
    public function apply(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'tel' => 'required|tel'
        ], [], ['name' => '姓名', 'tel' => '手机号']);

        $user = session('user');

        if ($data = $this->service->apply($request->all(), $user)) {
            return $this->success($data);
        }

        return $this->error();
    }

    public function status()
    {
        /**
         * @var User $user
         */
        $user = session('user');

        return $this->success([
            'status' => $user->partner_status,
            'name' => $user->name
        ]);
    }

    public function postCards(Request $request)
    {
        $this->validate($request, [
            'real_name' => 'required',
            'card_number' => 'required',
            'branch_name' => 'required',
            'tel' => 'required|tel',
        ], [], ['real_name' => '持卡人姓名', 'card_number' => '银行卡号', 'branch_name' => '开户行名称', 'tel' => '银行预留手机号']);

        $data = $this->service->addCard($request->all());

        return $this->success($data);
    }

    public function beforeCash()
    {
        $data = $this->service->getBeforeCashData();

        return $this->success($data);
    }

    public function cashRequest(Request $request)
    {
        $this->validate($request, [
            'card_id' => 'required',
            'amount' => 'required',
        ], [], ['card_id' => '银行卡信息', 'amount' => '提现金额']);

        $data = $this->service->cashRequest($request->all());

        return $this->success($data);
    }

    public function cashRequestLogs()
    {
        $data = $this->service->cashRequestLogs();

        return $this->success($data);
    }

    /**
     * 获取合作者的推荐订单列表
     * @return JsonResponse
     */
    public function orders()
    {
        $data = $this->service->orders();

        return $this->success($data);
    }
}
