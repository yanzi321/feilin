<?php

namespace App\Http\Controllers\Admin;

use App\CommissionLog;
use App\Http\Requests\CreateCommissionLogRequest;
use App\Services\CommissionLogService;
use Illuminate\Http\Request;

// $commission_log
// $commission_logs
// CommissionLog
class CommissionLogController extends BaseController
{
    protected $service;

    public function __construct(CommissionLogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\CommissionLogCollection|\App\Http\Resources\CommissionLogCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $commission_logs = $this->service->collection($request->all());

        return $commission_logs;
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
     * @param CreateCommissionLogRequest $request
     * @return CommissionLogController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateCommissionLogRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param CommissionLog $commission_log
     * @return CommissionLogController|CommissionLogController|\Illuminate\Http\JsonResponse
     */
    public function show(CommissionLog $commission_log)
    {
        if (!$commission_log) {
            return $this->error();
        }

        $data = new \App\Http\Resources\CommissionLog($commission_log);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CommissionLog $commission_log
     * @return void
     */
    public function edit(CommissionLog $commission_log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param CommissionLog $commission_log
     * @return CommissionLogController|CommissionLogController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, CommissionLog $commission_log)
    {
        if ($this->service->update($commission_log, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CommissionLog $commission_log
     * @return CommissionLogController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(CommissionLog $commission_log)
    {
        if ($commission_log->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
