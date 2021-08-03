<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\ActivitySummerCamp
 *
 * @property int $id
 * @property string $name 姓名
 * @property string $tel 电话
 * @property string $wants_country 意向国家
 * @property string|null $ip IP地址
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereWantsCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\ActivitySummerCamp withoutTrashed()
 * @mixin \Eloquent
 * @property int|null $user_id 报名用户的 user_id 呀
 * @property int|null $from_id 来源id
 * @property string|null $from 来源场景
 * @property string|null $consult_at 咨询时间
 * @property string|null $avatar 头像
 * @property string|null $place 地区
 * @property string|null $remark 备注
 * @property int|null $sex 性别：1 男 2 女 3 其他
 * @property int|null $age 年龄
 * @property int|null $grade 所在年级
 * @property string|null $school 所在学校
 * @property string|null $language_level 语言成绩
 * @property string|null $parent_name 父母姓名
 * @property string|null $parent_tel 父母电话
 * @property string|null $email 邮箱
 * @property int|null $organization_id 如果是机构推广，此处显示机构id
 * @property int|null $extern_salesman_id 外部业务员id
 * @property-read \App\Order $order
 * @property-read \App\Organization|null $organization
 * @property-read \App\User|null $partner
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereConsultAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereExternSalesmanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereLanguageLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereOrganizationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereParentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereParentTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp wherePlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ActivitySummerCamp whereUserId($value)
 */
class ActivitySummerCamp extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    /**
     * 该条记录对应的合作者信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    /**
     * 该条报名记录对应的订单
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order()
    {
        return $this->hasOne(Order::class);
    }

    /***
     * 所属机构信息
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function externSalesman()
    {
        return $this->belongsTo(ExternSalesman::class, 'extern_salesman_id');
    }
}
