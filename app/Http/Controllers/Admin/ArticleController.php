<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Http\Requests\CreateArticle;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    protected $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\ArticleCollection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $articles = $this->service->collection($request->query());

        return $articles;
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
     * @param CreateArticle $request
     * @return ArticleController|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\ErrorException
     */
    public function store(CreateArticle $request)
    {
        if ($this->service->store($request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return ArticleController|\Illuminate\Http\JsonResponse
     */
    public function show(Article $article)
    {
        if (!$article) {
            return $this->error();
        }

        $article->tag_ids = $article->tags->map(function($tag) {
            return $tag['id'];
        });

        $data = new \App\Http\Resources\Article($article);

        return $this->success($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateArticle $request
     * @param  \App\Article $article
     * @return ArticleController|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     * @throws \App\Exceptions\ErrorException
     */
    public function update(CreateArticle $request, Article $article)
    {
        if ($this->service->update($article, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return ArticleController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return $this->success();
        }

        return $this->error();
    }
}
