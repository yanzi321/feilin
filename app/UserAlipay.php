<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserAlipay
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $account 支付宝账户名
 * @property string $last_used_at 最近一次使用的时间，用于提示最近一次数据
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereLastUsedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserAlipay whereUserId($value)
 * @mixin \Eloquent
 */
class UserAlipay extends Model
{
    //
}
