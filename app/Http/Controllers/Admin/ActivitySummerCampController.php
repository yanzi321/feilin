<?php

namespace App\Http\Controllers\Admin;

use App\ActivitySummerCamp;
use App\Http\Requests\CreateActivitySummerCampRequest;
use App\Services\ActivitySummerCampService;
use Illuminate\Http\Request;

// $activity_summer_camp
// $activity_summer_camps
// ActivitySummerCamp
class ActivitySummerCampController extends BaseController
{
    protected $service;

    public function __construct(ActivitySummerCampService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\ActivitySummerCampCollection|\App\Http\Resources\ActivitySummerCampCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $activity_summer_camps = $this->service->collection($request->all());

        return $activity_summer_camps;
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
     * @param CreateActivitySummerCampRequest $request
     * @return ActivitySummerCampController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateActivitySummerCampRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param ActivitySummerCamp $activity_summer_camp
     * @return ActivitySummerCampController|ActivitySummerCampController|\Illuminate\Http\JsonResponse
     */
    public function show(ActivitySummerCamp $activity_summer_camp)
    {
        if (!$activity_summer_camp) {
            return $this->error();
        }

        $data = new \App\Http\Resources\ActivitySummerCamp($activity_summer_camp);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivitySummerCamp $activity_summer_camp
     * @return void
     */
    public function edit(ActivitySummerCamp $activity_summer_camp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ActivitySummerCamp $activity_summer_camp
     * @return ActivitySummerCampController|ActivitySummerCampController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ActivitySummerCamp $activity_summer_camp)
    {
        if ($this->service->update($activity_summer_camp, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivitySummerCamp $activity_summer_camp
     * @return ActivitySummerCampController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ActivitySummerCamp $activity_summer_camp)
    {
        if ($activity_summer_camp->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
