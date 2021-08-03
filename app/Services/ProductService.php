<?php

namespace App\Services;

use App\Product;
use App\Http\Resources\ProductCollection;
use App\Exceptions\ErrorException;

// Product
// 产品
//  $product
// $products

class ProductService extends BaseService
{
    /**
     * 获取产品列表
     * @param null $params
     * @return ProductCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $products = Product::orderBy('sort')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new ProductCollection($products);
    }

    /**
     * 获取产品详情
     * @param $id
     * @return ProductCollection
     */
    public function resource($id)
    {
        $product = Product::find($id);

        return new ProductCollection($product);
    }

    /**
     * 新增产品
     * @param array $data
     * @return Product|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Product::create($data);
    }

    /**
     * 更新产品
     * @param Product $product
     * @param $data
     * @return bool
     */
    public function update(Product $product, $data)
    {
        return $product->update($data);
    }
}
