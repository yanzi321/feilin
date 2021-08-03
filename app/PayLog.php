<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PayLog
 *
 * @property int $id
 * @property int $admin_id 操作人员
 * @property int $order_id 对应订单
 * @property float $paid_fee 缴费金额
 * @property string $paid_at 缴费时间
 * @property string|null $remark 缴费备注
 * @property int $status 预留字段
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog wherePaidFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\PayLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\PayLog withoutTrashed()
 * @mixin \Eloquent
 */
class PayLog extends Model
{
    // use SoftDeletes;

    protected $guarded = [];
}
