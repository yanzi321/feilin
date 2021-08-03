<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Organization
 *
 * @property int $id
 * @property string $name 结构名称
 * @property string|null $logo logo
 * @property string|null $images 图片，多个图片
 * @property string|null $description 机构简介
 * @property string $content 结构详情
 * @property string|null $url 官网URL链接
 * @property int $sort 排序，值越小排序越靠前
 * @property int $status 状态
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Organization onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Organization withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Organization withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $added_at 入驻时间
 * @property string|null $tel 手机号
 * @property string|null $contact 联系方式
 * @property string|null $notice 报名须知
 * @property int|null $salesman_id 所属业务员 id。其实就是 admin 啦
 * @property int|null $from 来源
 * @property int|null $from_id 具体来源的 id
 * @property string|null $qrcode_link 二维码信息，无用字段，为方便插入用的
 * @property-read \App\Admin|null $salesman
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereAddedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereQrcodeLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereSalesmanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Organization whereTel($value)
 * @property-read \App\Protocol $protocol
 */
class Organization extends Model
{
    /**
     * 机构类型
     */
    const TYPE_ORG = 1;

    /**
     * 外部业务员类型
     */
    const TYPE_EXTERN_SALESMAN = 2;

    /**
     * 内部业务员类型
     */
    const TYPE_SALESMAN = 3;

    // use SoftDeletes;

    protected $guarded = [];

    /**
     * 这个机构所属的业务员
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function salesman()
    {
        return $this->belongsTo(Admin::class, 'salesman_id');
    }

    public function protocol()
    {
        return $this->hasOne(Protocol::class);
    }
}
