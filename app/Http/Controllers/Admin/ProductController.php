<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Http\Requests\CreateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

// $product
// $products
// Product
class ProductController extends BaseController
{
    protected $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \App\Http\Resources\ProductCollection|\App\Http\Resources\ProductCollection|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $products = $this->service->collection($request->all());

        return $products;
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
     * @param CreateProductRequest $request
     * @return ProductController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateProductRequest $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductController|ProductController|\Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        if (!$product) {
            return $this->error();
        }

        $data = new \App\Http\Resources\Product($product);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Product $product
     * @return ProductController|ProductController|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Product $product)
    {
        if ($this->service->update($product, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return ProductController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
