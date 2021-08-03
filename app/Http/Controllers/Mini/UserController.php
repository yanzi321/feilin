<?php

namespace App\Http\Controllers\Mini;

use App\Http\Requests\CreateActivitySummerCampRequest;
use App\Services\ActivitySummerCampService;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * 获取合作者的推荐订单列表
     * @return JsonResponse
     */
    public function orders()
    {
        $data = (new OrderService())->getUserOrders(session('user'));

        return $this->success($data);
    }

    /**
     * 报名
     * @param CreateActivitySummerCampRequest $request
     * @return \App\ActivitySummerCamp|\Illuminate\Database\Eloquent\Model
     * @throws \App\Exceptions\ErrorException
     */
    public function activityCamp(CreateActivitySummerCampRequest $request)
    {
        $data = (new ActivitySummerCampService())->store($request->all());

        return $this->success($data);
    }
}
