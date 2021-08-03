<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Piece
 *
 * @property int $id
 * @property int $piece_model_id
 * @property string $name 碎片名称
 * @property string $text text 类型的值
 * @property string $url url 类型的值
 * @property string $image image 类型的值
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\PieceModel $pieceModel
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece wherePieceModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereUrl($value)
 * @mixin \Eloquent
 * @property string $values 碎片具体的内容
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Piece onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Piece whereValues($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Piece withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Piece withoutTrashed()
 */
class Piece extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function pieceModel()
    {
        return $this->belongsTo(PieceModel::class);
    }
}
