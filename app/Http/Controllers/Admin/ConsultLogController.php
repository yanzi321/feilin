<?php

namespace App\Http\Controllers\Admin;

use App\ConsultLog;
use App\Http\Requests\CreateConsultLogRequest;
use App\Services\ConsultLogService;
use Illuminate\Http\Request;

// $consultLog
// ConsultLog
class ConsultLogController extends BaseController
{
    protected $service;

    public function __construct(ConsultLogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\ConsultLogCollection|\App\Http\Resources\ConsultLogCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $consultLogs = $this->service->collection($request->all());

        return $consultLogs;
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
     * @param CreateConsultLogRequest $request
     * @return ConsultLogController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateConsultLogRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param ConsultLog $consultLog
     * @return ConsultLogController|ConsultLogController|\Illuminate\Http\JsonResponse
     */
    public function show(ConsultLog $consultLog)
    {
        if (!$consultLog) {
            return $this->error();
        }

        $data = new \App\Http\Resources\ConsultLog($consultLog);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsultLog $consultLog
     * @return void
     */
    public function edit(ConsultLog $consultLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ConsultLog $consultLog
     * @return ConsultLogController|ConsultLogController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ConsultLog $consultLog)
    {
        if ($this->service->update($consultLog, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConsultLog $consultLog
     * @return ConsultLogController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ConsultLog $consultLog)
    {
        if ($consultLog->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
