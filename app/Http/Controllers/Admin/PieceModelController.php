<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePieceModel;
use App\PieceModel;
use App\Services\PieceModelService;
use Illuminate\Http\Request;

class PieceModelController extends BaseController
{
    /**
     * @var PieceModelService
     */
    protected $service;

    public function __construct(PieceModelService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $pieceModels = $this->service->collection($request->query());

        return $this->success($pieceModels);
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
     * @param CreatePieceModel $request
     * @return PieceModelController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreatePieceModel $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PieceModel $pieceModel
     * @return PieceModelController|\Illuminate\Http\JsonResponse
     */
    public function show(PieceModel $pieceModel)
    {
        if (!$pieceModel) {
            return $this->error();
        }

        $data = new \App\Http\Resources\PieceModel($pieceModel);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PieceModel $pieceModel
     * @return void
     */
    public function edit(PieceModel $pieceModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\PieceModel $pieceModel
     * @return PieceModelController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function update(Request $request, PieceModel $pieceModel)
    {
        if ($this->service->update($pieceModel, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PieceModel $pieceModel
     * @return PieceModelController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(PieceModel $pieceModel)
    {
        if ($pieceModel->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
