<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Protocol
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Protocol onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Protocol withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Protocol withoutTrashed()
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $path 路径
 * @property int $from 来源，比如：组织，业务员等
 * @property int $from_id 具体哪个人
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol wherePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereUpdatedAt($value)
 * @property int|null $extern_salesman_id 外部业务员id
 * @property int|null $organization_id 机构id
 * @property-read \App\ExternSalesman|null $externSalesman
 * @property-read \App\Organization|null $organization
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereExternSalesmanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Protocol whereOrganizationId($value)
 */
class Protocol extends Model
{
    protected $guarded = [];

    public function externSalesman()
    {
        return $this->belongsTo(ExternSalesman::class, 'extern_salesman_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
}
