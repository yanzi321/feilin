<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ProductCategory
 *
 * @property int $id
 * @property string $name 分类名称
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ProductCategory withoutTrashed()
 * @mixin \Eloquent
 */
class ProductCategory extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
