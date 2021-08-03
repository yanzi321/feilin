<?php

namespace App\Http\Controllers\Admin;

use App\Services\ReportService;
use Illuminate\Http\Request;


class ReportController extends BaseController
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }

    public function summary(Request $request)
    {
        $reports = $this->service->summary($request->all());

        return $this->success($reports);
    }

    public function orders(Request $request)
    {
        $orders = $this->service->orders($request->all());

        return $orders;
    }

    public function products(Request $request)
    {
        $products = $this->service->products($request->all());

        return $this->success($products);
    }

    public function salesmen(Request $request)
    {
        $saleman = $this->service->salesmen($request->all());

        return $this->success($saleman);
    }

    public function order_count(Request $request)
    {
        $type = $request->input('type', null);
        $data = $this->service->order_count(compact('type'));
        return $this->success($data);
    }

    public function order_amount(Request $request)
    {
        $type = $request->input('type', null);
        $data = $this->service->order_amount(compact('type'));
        return $this->success($data);
    }

    public function salesman_count()
    {
        $data = $this->service->salesman_count();
        return $this->success($data);
    }

    public function customer_count()
    {
        $data = $this->service->customer_count();
        return $this->success($data);
    }

    public function partner_count()
    {
        $data = $this->service->partner_count();
        return $this->success($data);
    }
}
