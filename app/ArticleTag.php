<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ArticleTag
 *
 * @property int $id
 * @property int $article_id article 主键
 * @property int $tag_id tag 主键
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereArticleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ArticleTag whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ArticleTag withoutTrashed()
 */
class ArticleTag extends Model
{
    // use SoftDeletes;

    protected $table = 'article_tag';
}
