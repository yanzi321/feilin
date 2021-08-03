<?php

namespace App\Http\Controllers;

use App\Organization;
use App\Services\OrganizationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class OrganizationController extends BaseController
{
    protected $service;

    public function __construct(OrganizationService $service)
    {
        $this->service = $service;
    }

    public function info()
    {
        $id = $this->service->getOrganizationId();

        return $this->success([
            'id' => $id,
            'type' => 'org'
        ]);
    }

    public function index()
    {
        return $this->service->collection(['all' => true, 'status' => true, 'type' => Organization::TYPE_ORG]);
    }

    public function show(Request $request)
    {
        $this->validate($request, [
            'org' => 'required'
        ]);

        $id = Crypt::decrypt(
            urldecode($request->org)
        );

        /**
         * @var $detail Organization
         */
        $detail = Organization::find($id);

        if (empty($detail)) {
            return $this->error('无机构信息');
        }

        return $this->success([
            'name' => $detail->name,
            'type' => $detail->type,
            'content' => $detail->content,
            'contact' => $detail->contact,
            'notice' => $detail->notice,
            'logo' => $detail->logo,
            'description' => $detail->description
        ]);
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
