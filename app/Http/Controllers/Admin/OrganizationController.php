<?php

namespace App\Http\Controllers\Admin;

use App\Organization;
use App\Http\Requests\CreateOrganizationRequest;
use App\Services\OrganizationService;
use Illuminate\Http\Request;

// $organization
// $organizations
// Organization
class OrganizationController extends BaseController
{
    protected $service;

    public function __construct(OrganizationService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\OrganizationCollection|\App\Http\Resources\OrganizationCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $organizations = $this->service->collection($request->all());

        return $organizations;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateOrganizationRequest $request
     * @return OrganizationController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateOrganizationRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param Organization $organization
     * @return OrganizationController|OrganizationController|\Illuminate\Http\JsonResponse
     */
    public function show(Organization $organization)
    {
        if (!$organization) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Organization($organization);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization $organization
     * @return void
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Organization $organization
     * @return OrganizationController|OrganizationController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Organization $organization)
    {
        if ($this->service->update($organization, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Organization $organization
     * @return OrganizationController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Organization $organization)
    {
        if ($organization->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
