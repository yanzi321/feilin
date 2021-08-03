<?php

namespace App\Http\Controllers\Admin;

use App\Piece;
use App\Services\PieceService;
use Illuminate\Http\Request;

class PieceController extends BaseController
{
    /**
     * @var PieceService
     */
    protected $service;

    public function __construct(PieceService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\PieceCollection
     */
    public function index(Request $request)
    {
        $pieces = $this->service->collection($request->query());

        return $pieces;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return PieceController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(Request $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Piece $piece
     * @return PieceController|\Illuminate\Http\JsonResponse
     */
    public function show(Piece $piece)
    {
        if (!$piece) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Piece($piece);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Piece $piece
     * @return \Illuminate\Http\Response
     */
    public function edit(Piece $piece)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Piece $piece
     * @return PieceController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function update(Request $request, Piece $piece)
    {
        if ($this->service->update($piece, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Piece $piece
     * @return PieceController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Piece $piece)
    {
        if ($piece->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
