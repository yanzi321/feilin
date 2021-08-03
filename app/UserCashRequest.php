<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\UserCashRequest
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $name 姓名
 * @property string $tel 电话
 * @property int $cash_way 提现方式：1、支付宝 2、银行卡
 * @property string|null $alipay_account 支付宝账号
 * @property string|null $bank_name 银行
 * @property string|null $branch_name 支行名称
 * @property string|null $card_number 银行卡号信息
 * @property float $cash_amount 体现金额
 * @property int $status 体现状态：0 未审核  1 处理中 2 已审核 3 审核失败
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\User $user
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\UserCashRequest onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereAlipayAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereCashAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereCashWay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCashRequest whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\UserCashRequest withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\UserCashRequest withoutTrashed()
 * @mixin \Eloquent
 */
class UserCashRequest extends Model
{
    // use SoftDeletes;

    // 提现方式
    const CASH_WAY_ALIPAY = 1;
    const CASH_WAY_BANK = 2;

    // 处理状态
    const STATUS_PENDING = 0;
    const STATUS_IN_PROCESS = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAILED = 3;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
