<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTagRequest;
use App\Services\TagService;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends BaseController
{
    protected $service;

    public function __construct(TagService $modelService)
    {
        $this->service = $modelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $tags = $this->service->collection();

        return $this->success($tags);
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
     * @param CreateTagRequest $request
     * @return TagController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateTagRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag $tag
     * @return TagController|\Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag)
    {
        if (!$tag) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Tag($tag);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag $tag
     * @return void
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Tag $tag
     * @return TagController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Tag $tag)
    {
        if ($this->service->update($tag, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag $tag
     * @return TagController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Tag $tag)
    {
        if ($tag->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
