<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ConsultLog
 *
 * @property int $id
 * @property int $user_id 关联的注册用户
 * @property string|null $name 咨询者姓名
 * @property string|null $tel 咨询者电话
 * @property string $content 咨询内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ConsultLog withoutTrashed()
 * @mixin \Eloquent
 * @property int $activity_summer_camp_id 报名记录id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ConsultLog whereActivitySummerCampId($value)
 */
class ConsultLog extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
