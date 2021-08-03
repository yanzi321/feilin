<?php

namespace App\Http\Controllers;

use App\Services\ExternSalesmanService;

class ExternSalesmanController extends BaseController
{
    protected $service;

    public function __construct(ExternSalesmanService $service)
    {
        $this->service = $service;
    }

    public function orders()
    {
        $orders = $this->service->orders();

        return $this->success($orders);
    }

    public function organizationOrders()
    {
        $organizationOrders = $this->service->organizationOrders();

        return $this->success($organizationOrders);
    }

    public function protocol()
    {
        $protocol = $this->service->protocol();

        return $this->success($protocol);
    }
}
