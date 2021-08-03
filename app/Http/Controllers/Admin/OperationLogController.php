<?php

namespace App\Http\Controllers\Admin;

use App\Models\Basic\OperationLog;
use App\Http\Requests\CreatePayLogRequest;
use App\Services\OperationLogService;
use Illuminate\Http\Request;

// $payLog
// $payLogs
// PayLog
class OperationLogController extends BaseController
{
    protected $service;

    public function __construct(OperationLogService $service)
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
        return $this->success($payLogs);

    }

}
