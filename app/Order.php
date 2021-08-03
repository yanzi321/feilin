<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Order
 *
 * @property int $id
 * @property string $order_sn 订单编号
 * @property int $user_id 订单用户
 * @property int $product_id 订单产品
 * @property string $product_snapshot 产品快照
 * @property string $wants_country 意向国家
 * @property float $total_fee 总费用
 * @property float $left_fee 剩余金额
 * @property string|null $remark 订单备注
 * @property int $status 预留字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Order onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereLeftFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereOrderSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereProductSnapshot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereTotalFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereWantsCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Order withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Order withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\PayLog[] $payLogs
 * @property-read \App\Product $product
 * @property int $from
 * @property int $from_id
 * @property float $commission 佣金比例，如 12.34%，储存为 1234
 * @property float $paid_fee 已付金额
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order wherePaidFee($value)
 * @property int|null $admin_id 管理员信息，订单创建者信息，关联到adimn表
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereAdminId($value)
 * @property-read \App\Admin|null $admin
 * @property int $activity_summer_camp_id 报名记录id
 * @property-read \App\ActivitySummerCamp $activitySummerCamp
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Order whereActivitySummerCampId($value)
 */
class Order extends Model
{
    // use SoftDeletes;

    // 状态类枚举参数
    const IN_CONSULT_STATUS = 1; // 咨询中
    const SIGNED_UNPAY_STATUS = 2; // 签约未付款
    const SIGNED_PAY_STATUS = 3; // 签约付款
    const IN_SERVICE_STATUS = 4; // 服务中
    const SERVICE_SUCCESS_STATUS = 5; // 服务成功
    const IN_REFUND_STATUS = 6; // 退款中
    const REFUND_SUCCESS_STATUS = 7; // 退款成功

    protected $guarded = [];

    /**
     * 订单所属用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activitySummerCamp()
    {
        return $this->belongsTo(ActivitySummerCamp::class);
    }

    /**
     * 订单的创建者|管理员
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payLogs()
    {
        return $this->hasMany(PayLog::class);
    }
}
