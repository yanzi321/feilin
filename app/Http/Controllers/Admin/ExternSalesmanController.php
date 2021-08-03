<?php

namespace App\Http\Controllers\Admin;

use App\ExternSalesman;
use Illuminate\Http\Request;
use App\Services\ExternSalesmanService;
use App\Http\Requests\CreateExternSalesmanRequest;

class ExternSalesmanController extends BaseController
{
    protected $service;

    public function __construct(ExternSalesmanService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $ExternSalesmen = $this->service->collection($request->all());

        return $ExternSalesmen;
    }

    public function create()
    {
    }

    public function store(CreateExternSalesmanRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function show(ExternSalesman $ExternSalesman)
    {
        if (!$ExternSalesman) {
            return $this->error();
        }

        $data = new \App\Http\Resources\ExternSalesman($ExternSalesman);

        return $this->success($data);
    }

    public function edit(ExternSalesman $ExternSalesman)
    {
    }

    public function update(Request $request, ExternSalesman $ExternSalesman)
    {
        if ($this->service->update($ExternSalesman, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function destroy(ExternSalesman $ExternSalesman)
    {
        if ($ExternSalesman->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
