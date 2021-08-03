<?php

namespace App\Services;

use App\ExternSalesman;
use App\Exceptions\ErrorException;
use App\Http\Resources\ExternSalesmanCollection;
use App\Http\Resources\ExternSalesman as ExternSalesmanResource;
use App\Organization;
use App\Protocol;
use App\User;

class ExternSalesmanService extends BaseService
{
    public function getExternSalesmanId()
    {
        if (!session('info')) {
            return null;
        }

        $info = session('info');

        // 类型不是机构的，跳过
        if ($info->type != 'extern_salesman') {
            return null;
        }

        return intval($info->id);
    }

    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $ExternSalesmen = ExternSalesman::orderBy('sort')
            ->with('protocol')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new ExternSalesmanCollection($ExternSalesmen);
    }

    public function resource($id)
    {
        $ExternSalesman = ExternSalesman::find($id);

        return ExternSalesmanResource::collection($ExternSalesman);
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $data['admin_id'] = auth('admin')->id();

        return ExternSalesman::create($data);
    }

    public function update(ExternSalesman $ExternSalesman, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $ExternSalesman->update($data);
        }

        return $ExternSalesman->update($data);
    }

    public function orders($externSalesmanId = null)
    {
        if (is_null($externSalesmanId)) {
            $externSalesmanId = $this->getExternSalesmanId();
        }

        $data = \DB::table('orders')->selectRaw(
            'orders.id as order_id, ' .
            'orders.order_sn as order_sn, ' .
            'orders.status as order_status, ' .

            'products.id as product_id, ' .
            'products.name as product_name, ' .

            '"" as user_nickname, ' .
            '"" as user_avatar, ' .

            'activity_summer_camps.name as user_name, ' .
            'activity_summer_camps.tel as user_tel, ' .

            'admins.id as admin_id, ' .
            'admins.name as admin_name, ' .

            'sum(commission_logs.commission) as commission'
        )->where('orders.from', User::FROM_EXTERN_SALESMAN)
            ->where('orders.from_id', $externSalesmanId)
//            ->leftJoin('users', function ($join) {
//                $join->on('users.id', '=', 'orders.user_id');
//            })->leftJoin('wechat_users', function ($join) {
//                $join->on('wechat_users.openid', '=', 'users.openid');
//            })
            ->leftJoin('activity_summer_camps', function ($join) {
                $join->on('orders.activity_summer_camp_id', '=', 'activity_summer_camps.id');
            })
            ->leftJoin('products', function ($join) {
                $join->on('orders.product_id', '=', 'products.id');
            })->leftJoin('admins', function ($join) {
                $join->on('orders.admin_id', '=', 'admins.id');
            })->leftJoin('commission_logs', function ($join) {
                $join->on('orders.id', '=', 'commission_logs.order_id');
            })->groupBy('orders.id')->get();

        return $data;
    }

    public function protocol($externSalesmanId = null)
    {
        if (is_null($externSalesmanId)) {
            $externSalesmanId = $this->getExternSalesmanId();
        }


        return Protocol::whereExternSalesmanId(intval($externSalesmanId))->first();
    }


    /**
     * 获取该外部业务员的机构推荐的订单列表
     * Step1. 获取该用户的推荐的机构列表
     * Step2. 获取已知机构的订单列表
     *
     * @return \Illuminate\Support\Collection
     */
    public function organizationOrders()
    {
        $orgs = $this->getChildOrganizations();

        if (empty($orgs)) {
            return [];
        }

        $orgIds = $orgs->map(function ($org) {
            return $org->id;
        })->values();

        $data = \DB::table('orders')->selectRaw(
            'orders.id as order_id, ' .
            'orders.order_sn as order_sn, ' .
            'orders.status as order_status, ' .

            'products.id as product_id, ' .
            'products.name as product_name, ' .

            '"" as user_nickname, ' .
            '"" as user_avatar, ' .

            'activity_summer_camps.name as user_name, ' .
            'activity_summer_camps.tel as user_tel, ' .

            'admins.id as admin_id, ' .
            'admins.name as admin_name, ' .

            'organizations.name as org_name, ' .
            'organizations.id as org_id, ' .

            'sum(commission_logs.commission) as commission'
        )->where('orders.from', User::FROM_ORGANIZATION)
            ->whereIn('orders.from_id', $orgIds)
            ->leftJoin('activity_summer_camps', function ($join) {
                $join->on('orders.activity_summer_camp_id', '=', 'activity_summer_camps.id');
            })
            ->leftJoin('products', function ($join) {
                $join->on('orders.product_id', '=', 'products.id');
            })->leftJoin('admins', function ($join) {
                $join->on('orders.admin_id', '=', 'admins.id');
            })->leftJoin('organizations', function ($join) {
                $join->on('organizations.id', '=', 'orders.from_id');
            })->leftJoin('commission_logs', function ($join) {
                $join->on('orders.id', '=', 'commission_logs.order_id');
            })->groupBy('orders.id')->get();

        return $data;
    }

    /**
     * 获取推荐的机构列表
     * @return \Illuminate\Support\Collection
     */
    public function getChildOrganizations()
    {
        $externSalesmanId = $this->getExternSalesmanId();

        $list = Organization::select('id')->where('from', User::FROM_EXTERN_SALESMAN)
            ->where('from_id', $externSalesmanId)
            ->get();

        return $list;
    }
}
