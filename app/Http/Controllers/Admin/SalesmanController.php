<?php

namespace App\Http\Controllers\Admin;

use App\Salesman;
use App\Http\Requests\CreateSalesmanRequest;
use App\Services\SalesmanService;
use Illuminate\Http\Request;

// $salesman
// $salesmen
// Salesman
class SalesmanController extends BaseController
{
    protected $service;

    public function __construct(SalesmanService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\SalesmanCollection|\App\Http\Resources\SalesmanCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $salesmen = $this->service->collection($request->all());

        return $salesmen;
    }

    public function customers(Request $request, $id)
    {
        $customers = $this->service->customers($id);

        return $this->success($customers);
    }

    public function orders(Request $request, $id)
    {
        $orders = $this->service->orders($id);

        return $this->success($orders);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSalesmanRequest $request
     * @return SalesmanController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateSalesmanRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param Salesman $salesman
     * @return SalesmanController|SalesmanController|\Illuminate\Http\JsonResponse
     */
    public function show(Salesman $salesman)
    {
        if (!$salesman) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Salesman($salesman);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salesman $salesman
     * @return void
     */
    public function edit(Salesman $salesman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Salesman $salesman
     * @return SalesmanController|SalesmanController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Salesman $salesman)
    {
        if ($this->service->update($salesman, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salesman $salesman
     * @return SalesmanController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Salesman $salesman)
    {
        if ($salesman->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
