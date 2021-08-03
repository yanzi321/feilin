<?php

namespace App\Services;

use App\Category;
use App\Exceptions\ErrorException;
use App\Http\Resources\CategoryCollection;

class CategoryService
{
    /**
     * 获取管理员列表
     * @return CategoryCollection
     */
    public function collection($params = null)
    {
        $categories = new CategoryCollection(Category::orderByDesc('status')->orderBy('sort')->get());

        return $categories;
    }

    /**
     * @param $id
     * @return CategoryCollection
     */
    public function resource($id)
    {
        $category = Category::find($id);

        return new CategoryCollection($category);
    }

    /**
     * @param array $data
     * @return Category|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Category::create($data);
    }

    /**
     * @param Category $category
     * @param $data
     * @return bool
     */
    public function update(Category $category, $data)
    {
        return $category->update($data);
    }
}
