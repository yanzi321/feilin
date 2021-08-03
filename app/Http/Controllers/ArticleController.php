<?php

namespace App\Http\Controllers;

use App\Article;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    private $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $category_id = $request->input('category_id', 0);

        return $this->service->collectionForPc(compact('category_id'));
    }

    public function hots(Request $request)
    {
        $category_id = $request->input('category_id', 0);
        $is_recommend = 1;

        return $this->service->collectionForPc(compact('category_id', 'is_recommend'));
    }

    public function show(Request $request, $id)
    {
        $article = Article::where('status', 1)->with('tags')->find($id);

        if (empty($article)) {
            return $this->error('文章获取失败');
        }

        $data = new \App\Http\Resources\Article($article);

        return $this->success($data);
    }
}
