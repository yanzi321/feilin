<?php

namespace App\Http\Controllers\Admin;

use App\UserCashRequest;
use App\Http\Requests\CreateUserCashRequestRequest;
use App\Services\UserCashRequestService;
use Illuminate\Http\Request;

// $user_cash_request
// $user_cash_requests
// UserCashRequest
class UserCashRequestController extends BaseController
{
    protected $service;

    public function __construct(UserCashRequestService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\UserCashRequestCollection|\App\Http\Resources\UserCashRequestCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user_cash_requests = $this->service->collection($request->all());

        return $user_cash_requests;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserCashRequestRequest $request
     * @return UserCashRequestController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateUserCashRequestRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function show($id)
    {
        $data = $this->service->resource($id);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\UserCashRequest $user_cash_request
     * @return void
     */
    public function edit(UserCashRequest $user_cash_request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param UserCashRequest $user_cash_request
     * @return UserCashRequestController|UserCashRequestController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, UserCashRequest $user_cash_request)
    {
        if ($this->service->update($user_cash_request, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\UserCashRequest $user_cash_request
     * @return UserCashRequestController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(UserCashRequest $user_cash_request)
    {
        if ($user_cash_request->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
