<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Salesman
 *
 * @property int $id
 * @property string $name 姓名
 * @property string|null $tel 手机
 * @property string|null $job_number 工号
 * @property string $email 邮箱
 * @property string|null $email_verified_at
 * @property string $password
 * @property int $status
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Order[] $orders
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Salesman onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereJobNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Salesman whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Salesman withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Salesman withoutTrashed()
 * @mixin \Eloquent
 */
class Salesman extends Model
{
    // use SoftDeletes;

    protected $guarded = [];
    protected $table = 'admins';
    protected $hidden = ['password'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'from_id');
    }
}
