<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Article
 *
 * @property int $id
 * @property int $category_id 所属分类
 * @property string $author 作者
 * @property string $title 文章标题
 * @property string $description 文章简介
 * @property string $cover 文章封面
 * @property string $content 文章内容
 * @property int $status 文章状态
 * @property int $sort 排序，值越小排序越靠前
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Category $category
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $published_at 发布时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Tag[] $tags
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article wherePublishedAt($value)
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Article onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Article withoutTrashed()
 * @property int $is_recommend 是否是推荐位
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Article whereIsRecommend($value)
 */
use App\Models\Basic\UserShare;
use App\Models\Basic\UserLike;
use App\Models\Basic\UserEnshrine;
class Article extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    protected $appends=[
        'likeCount',
        'enshrineCount',
        'shareCount',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }
    public function getLikeCountAttribute(){

        $count=UserLike::where('article_id',$this->id)->count();
        return $count;
    }
    public function getEnshrineCountAttribute(){
        $count=UserEnshrine::where('article_id',$this->id)->count();
        return $count;
    }
    public function getShareCountAttribute(){
        $count=UserShare::where('article_id',$this->id)->count();
        return $count;
    }
}
