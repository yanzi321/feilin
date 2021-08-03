<?php

namespace App\Http\Controllers\Admin;

use App\PayLog;
use App\Http\Requests\CreatePayLogRequest;
use App\Services\PayLogService;
use Illuminate\Http\Request;

// $payLog
// $payLogs
// PayLog
class PayLogController extends BaseController
{
    protected $service;

    public function __construct(PayLogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\PayLogCollection|\App\Http\Resources\PayLogCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $payLogs = $this->service->collection($request->all());

        return $payLogs;
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
     * @param CreatePayLogRequest $request
     * @return PayLogController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreatePayLogRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param PayLog $payLog
     * @return PayLogController|PayLogController|\Illuminate\Http\JsonResponse
     */
    public function show(PayLog $payLog)
    {
        if (!$payLog) {
            return $this->error();
        }

        $data = new \App\Http\Resources\PayLog($payLog);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PayLog $payLog
     * @return void
     */
    public function edit(PayLog $payLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param PayLog $payLog
     * @return PayLogController|PayLogController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, PayLog $payLog)
    {
        if ($this->service->update($payLog, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PayLog $payLog
     * @return PayLogController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(PayLog $payLog)
    {
        if ($payLog->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
