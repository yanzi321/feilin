<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PieceModel
 *
 * @property int $id
 * @property string $name 模型名称
 * @property string $description 模型描述
 * @property string $fields 模型的字段定义
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Piece[] $pieces
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereFields($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PieceModel whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\PieceModel withoutTrashed()
 */
class PieceModel extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }
}
