<?php

namespace App\Services;

use App\Tag;
use App\Exceptions\ErrorException;
use App\Http\Resources\TagCollection;

class TagService
{
    /**
     * 获取管理员列表
     * @return TagCollection
     */
    public function collection($params = null)
    {
        $categories = new TagCollection(Tag::orderByDesc('status')->orderBy('sort')->get());

        return $categories;
    }

    /**
     * @param $id
     * @return TagCollection
     */
    public function resource($id)
    {
        $tag = Tag::find($id);

        return new TagCollection($tag);
    }

    /**
     * @param array $data
     * @return Tag|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Tag::create($data);
    }

    /**
     * @param Tag $tag
     * @param $data
     * @return bool
     */
    public function update(Tag $tag, $data)
    {
        return $tag->update($data);
    }
}
