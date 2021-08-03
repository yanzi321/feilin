<?php

namespace App\Http\Controllers\Pc;

use App\Http\Requests\CreateActivitySummerCampRequest;
use App\Services\ActivitySummerCampService;
use App\Traits\ApiResponse;

/**
 * Class ActivitySummerCampController
 * @package App\Http\Controllers
 */
class ActivitySummerCampController extends BaseController
{
    use ApiResponse;

    protected $service;

    public function __construct(ActivitySummerCampService $service)
    {
        $this->service = $service;
    }

    /**
     * @param CreateActivitySummerCampRequest $request
     * @return mixed
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateActivitySummerCampRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }
}
