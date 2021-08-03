<?php

namespace App\Http\Controllers\AdminV2;

use Illuminate\Http\Request;
use App\Models\Basic\SmsRecord;
use App\Http\RequestsV2\SmsRecordRequest;
use App\ServicesV2\SmsRecordService;

class SmsRecordController extends BaseController
{
    protected $service;

    public function __construct(SmsRecordService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $doctor = $this->service->collection($request->all());

        return $this->success($doctor);
    }

    public function store(SmsRecordRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    public function update(SmsRecordRequest $request, SmsRecord $smsRecord)
    {
        if ($this->service->update($smsRecord, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }
}
