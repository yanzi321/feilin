<?php

namespace App\Http\Controllers;


use App\Category;

class CategoryController extends BaseController
{
    public function index()
    {
        $categories = Category::select(['id', 'name'])
            ->orderBy('sort')
            ->where('status', 1)
            ->get();

        return $this->success($categories);
    }

}
