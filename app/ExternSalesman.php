<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ExternSalesman
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $tel 手机号
 * @property int $from 来源
 * @property int $from_id 具体来源的 id
 * @property int $admin_id 哪个管理员添加的
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property string|null $qrcode_link 二维码信息，无用字段，为方便插入用的
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereQrcodeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ExternSalesman whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Protocol $protocol
 */
class ExternSalesman extends Model
{
    protected $guarded = [];

    public function protocol()
    {
        return $this->hasOne(Protocol::class);
    }
}
