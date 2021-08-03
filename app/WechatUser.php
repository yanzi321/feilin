<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WechatUser
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser query()
 * @mixin \Eloquent
 * @property-read \App\User $user
 * @property int $id
 * @property string|null $openid openid信息
 * @property string|null $avatar 头像
 * @property string|null $nickname 昵称
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereOpenid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\WechatUser whereUpdatedAt($value)
 */
class WechatUser extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'openid', 'openid');
    }
}
