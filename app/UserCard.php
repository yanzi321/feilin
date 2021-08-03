<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\UserCard
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $card_number 银行卡号
 * @property string|null $bank_name 开户行
 * @property string|null $branch_name 支行名称
 * @property string $last_used_at 最近一次使用时间，用于提示最近使用的提现信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereBranchName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereCardNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereUserId($value)
 * @mixin \Eloquent
 * @property string $real_name 真实姓名
 * @property string $tel 银行预留手机号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereRealName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserCard whereTel($value)
 */
class UserCard extends Model
{
    protected $guarded = [];
}
