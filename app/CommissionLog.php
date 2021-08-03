<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CommissionLog
 *
 * @property int $id
 * @property int $order_id 订单id
 * @property int $user_id 用户id
 * @property int $partner_id 合作者id
 * @property float $commission 佣金金额
 * @property int $commission_rule_id 对应的佣金规则
 * @property string $commission_rule_snapshot 佣金规则快照
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Order $order
 * @property-read \App\User $partner
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereCommissionRuleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereCommissionRuleSnapshot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog wherePartnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionLog withoutTrashed()
 * @mixin \Eloquent
 * @property int $is_extra 是不是额外的奖励
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereIsExtra($value)
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionLog whereDeletedAt($value)
 */
class CommissionLog extends Model
{
    // use SoftDeletes;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function partner()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
