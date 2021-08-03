<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Services\CategoryService;

class CategoryController extends BaseController
{
    protected $modelService;

    public function __construct(CategoryService $modelService)
    {
        $this->modelService = $modelService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = $this->modelService->collection();

        return $this->success($categories);
    }
    
    public function categorieslist()
    {
        $categories = $this->modelService->collection();

        return $this->success($categories);
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
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateCategoryRequest $request)
    {
        if ($this->modelService->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Category $category)
    {
        if (!$category) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Category($category);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category $category
     * @return void
     */
    public function edit(Category $category)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateCategoryRequest $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        if ($this->modelService->update($category, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
