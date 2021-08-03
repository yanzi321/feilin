<?php

namespace App\Services;

use App\ProductCategory;
use App\Http\Resources\ProductCategoryCollection;
use App\Exceptions\ErrorException;

// ProductCategory
// 产品分类
//  $product_category
// $product_categories

class ProductCategoryService extends BaseService
{
    /**
     * 获取产品分类列表
     * @param null $params
     * @return ProductCategoryCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $product_categories = ProductCategory::orderBy('sort')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new ProductCategoryCollection($product_categories);
    }

    /**
     * 获取产品分类详情
     * @param $id
     * @return ProductCategoryCollection
     */
    public function resource($id)
    {
        $product_category = ProductCategory::find($id);

        return new ProductCategoryCollection($product_category);
    }

    /**
     * 新增产品分类
     * @param array $data
     * @return ProductCategory|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return ProductCategory::create($data);
    }

    /**
     * 更新产品分类
     * @param ProductCategory $product_category
     * @param $data
     * @return bool
     */
    public function update(ProductCategory $product_category, $data)
    {
        return $product_category->update($data);
    }
}
