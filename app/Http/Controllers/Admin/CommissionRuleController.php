<?php

namespace App\Http\Controllers\Admin;

use App\Services\CommissionRuleService;
use Illuminate\Http\Request;

class CommissionRuleController extends BaseController
{
    protected $service;

    public function __construct(CommissionRuleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $commission_rules = $this->service->collection($request->all());

        return $commission_rules;
    }

    /**
     * @param Request $request
     * @return CommissionRuleController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(Request $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }
}
