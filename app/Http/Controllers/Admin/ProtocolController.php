<?php

namespace App\Http\Controllers\Admin;

use App\Protocol;
use Illuminate\Http\Request;
use App\Services\ProtocolService;
use App\Http\Requests\CreateProtocolRequest;

class ProtocolController extends BaseController
{
    protected $service;

    public function __construct(ProtocolService $service)
    {
        $this->service = $service;
    }

    /**
     * 更新协议
     */
    public function update(Request $request)
    {
        if ($this->service->update($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * 上传协议
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $file = $request->file;

        $path = $file->store('protocol', 'public');

        $origin = "storage/{$path}";
        return $this->success([
            'origin' => asset($origin),
        ]);
    }
}
