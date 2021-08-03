<?php

namespace App\Services;

use App\Article;
use App\Exceptions\ErrorException;
use App\Http\Resources\ArticleCollection;

class ArticleService
{
    /**
     * 获取管理员列表
     * @return ArticleCollection|\Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function collection($params = null)
    {
        $title = $params['title'] ?? '';
        $category_id = $params['category_id'] ?? '';
        $published_range = $params['published_range'] ?? '';

        $articles = Article::orderByDesc('is_recommend')->orderByDesc('status')
            ->orderBy('sort')
            ->when($title, function ($query, $title) {
                return $query->where('title', 'like', "%$title%");
            })
            ->when($category_id, function ($query, $category_id) {
                return $query->where('category_id', $category_id);
            })
            ->when($published_range, function ($query, $published_range) {
                return $query->whereBetween('published_at', $published_range);
            })
            ->with('category:id,name')
            ->paginate();

        return new ArticleCollection($articles);
    }

    /**
     * @param $id
     * @return ArticleCollection()
     */
    public function resource($id)
    {
        $article = Article::find($id);

        return new ArticleCollection($article);
    }

    /**
     * @param array $data
     * @return Article|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        // 发布时间为空则为当前时间
        if (empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        // 需要单独维护文章对应的标签
        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $article = Article::create($data);
        if (!$article) {
            throw new ErrorException('article create exception');
        }

        // 同步文章对应的标签
        $article->tags()->sync($tag_ids);

        return $article;
    }

    /**
     * @param Article $article
     * @param $data
     * @return Article
     * @throws ErrorException
     */
    public function update(Article $article, $data)
    {
        if (isset($data['tag_ids'])) {
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);
            unset($data['tags']);
        }

        $res = $article->update($data);

        if (!$res) {
            throw new ErrorException('article create exception');
        }

        if (isset($data['tag_ids'])) {
            // 同步文章对应的标签
            $article->tags()->sync($tag_ids);
        }

        return $article;
    }

    /**
     * @param $params
     * @return ArticleCollection
     * @throws ErrorException
     */
    public function collectionForPc($params)
    {
        $category_id = $params['category_id'] ?? 0;
        $is_recommend = $params['is_recommend'] ?? 0;
        $size = $params['pageSize'] ?? 10;
        $articles = Article::where('status', 1)
            ->when($category_id, function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->when($is_recommend, function ($query) use ($is_recommend) {
                $query->where('is_recommend', $is_recommend);
            })
            // ->with('tags')
            ->orderBy('sort')
            ->paginate($size);

        if (!$articles) {
            throw new ErrorException('获取文章失败');
        }

        return (new ArticleCollection($articles));
    }
    //详情
    public function show($id){
        $article = Article::where(['id'=>$id])->first();   
        return $article;
    }
}
