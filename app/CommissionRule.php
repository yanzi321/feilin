<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\CommissionRule
 *
 * @property int $id
 * @property int $stage 阶段
 * @property int $max_number 当前阶段的最大人数
 * @property float $commission 佣金金额
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionRule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereMaxNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereStage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\CommissionRule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionRule withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\CommissionRule withoutTrashed()
 * @mixin \Eloquent
 */
class CommissionRule extends Model
{
    // use SoftDeletes;

    protected $guarded = [];
}
