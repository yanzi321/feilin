<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Product
 *
 * @property int $id
 * @property int $product_category_id
 * @property string $name 产品名称
 * @property string $commission 佣金比例，如 12.34%，储存为 1234
 * @property string $price 价格，单位：分
 * @property string|null $description 产品描述
 * @property string|null $content 详细内容
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\ProductCategory $category
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereProductCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Product withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 */
class Product extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @param $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return sprintf("%.2f", $value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getCommissionAttribute($value)
    {
        return sprintf("%.2f", $value);
    }
}
