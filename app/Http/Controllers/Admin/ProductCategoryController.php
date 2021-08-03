<?php

namespace App\Http\Controllers\Admin;

use App\ProductCategory;
use App\Http\Requests\CreateProductCategoryRequest;
use App\Services\ProductCategoryService;
use Illuminate\Http\Request;

// $product_category
// $product_categories
// ProductCategory
class ProductCategoryController extends BaseController
{
    protected $service;

    public function __construct(ProductCategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\ProductCategoryCollection|\App\Http\Resources\ProductCategoryCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $product_categories = $this->service->collection($request->all());

        return $product_categories;
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
     * @param CreateProductCategoryRequest $request
     * @return ProductCategoryController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateProductCategoryRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param ProductCategory $product_category
     * @return ProductCategoryController|ProductCategoryController|\Illuminate\Http\JsonResponse
     */
    public function show(ProductCategory $product_category)
    {
        if (!$product_category) {
            return $this->error();
        }

        $data = new \App\Http\Resources\ProductCategory($product_category);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory $product_category
     * @return void
     */
    public function edit(ProductCategory $product_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param ProductCategory $product_category
     * @return ProductCategoryController|ProductCategoryController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, ProductCategory $product_category)
    {
        if ($this->service->update($product_category, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory $product_category
     * @return ProductCategoryController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(ProductCategory $product_category)
    {
        if ($product_category->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
