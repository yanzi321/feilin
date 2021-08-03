<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $consult_at 咨询时间
 * @property string|null $avatar 头像
 * @property int|null $sex 性别：1 男 2 女 3 其他
 * @property int|null $age 年龄
 * @property int|null $grade 所在年级
 * @property string|null $school 所在学校
 * @property string|null $wants_country 意向国家，使用国家简写保存
 * @property string|null $language_level 语言成绩
 * @property string|null $parent_name 父母姓名
 * @property string|null $parent_tel 父母电话
 * @property string|null $wechat 微信
 * @property int|null $from 用户来源 默认为自有来源
 * @property int|null $from_id 用户来源id
 * @property int $status 账号状态，默认为开启
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ConsultLog[] $consultLogs
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereConsultAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLanguageLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereParentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereParentTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWantsCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWechat($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\User withoutTrashed()
 * @property int $is_partner 是否是合作伙伴
 * @property string|null $real_name 真实姓名
 * @property string|null $tel 手机号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereIsPartner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereTel($value)
 * @property int $partner_status 合作状态，默认：关闭
 * @property-read \App\Organization|null $organization
 * @property-read \App\User|null $partner
 * @property-read \App\Admin|null $salesman
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePartnerStatus($value)
 * @property string|null $nickname 微信昵称
 * @property string|null $openid 微信openid
 * @property string|null $unionid 微信unionid
 * @property string|null $wechat_snapshot 微信信息快照
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUnionid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereWechatSnapshot($value)
 * @property string|null $invite_code 邀请码
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereInviteCode($value)
 * @property string|null $place 地区
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePlace($value)
 * @property string|null $partner_apply_at 合作者申请时间
 * @property string|null $partner_approval_at 合作者审批时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePartnerApplyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePartnerApprovalAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;

    // 自有来源
    public const FROM_SELF = 0;

    // 业务员
    public const FROM_SALESMAN = 1;

    // 合作伙伴
    public const FROM_PARTNER = 2;

    // 机构
    public const FROM_ORGANIZATION = 3;

    // 来源外部业务员
    const FROM_EXTERN_SALESMAN = 4;

    protected $guarded = ['password', 'remember_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function consultLogs()
    {
        return $this->hasMany(ConsultLog::class, 'user_id');
    }

    public function salesman()
    {
        return $this->belongsTo(Admin::class, 'from_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'from_id');
    }

    public function partner()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    /**
     * 微信相关信息
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function wechat()
    {
        return $this->hasOne(WechatUser::class, 'user_id');
    }
}
