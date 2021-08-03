<?php

namespace App\Services;

use App\Organization;
use App\Http\Resources\OrganizationCollection;
use App\Exceptions\ErrorException;
use App\Http\Resources\Organization as OrganizationResource;
use App\Protocol;
use App\User;

// Organization
// 机构
//  $organization
// $organizations

class OrganizationService extends BaseService
{
    public function getOrganizationId()
    {
        if (!session('info')) {
            return null;
        }

        $info = session('info');

        // 类型不是机构的，跳过
        if ($info->type != 'organization') {
            return null;
        }

        return $info->id;
    }

    /**
     * 获取机构列表
     * @param null $params
     * @return OrganizationCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';
        $type = $params['type'] ?? '';
        $onlyMe = (isset($params['only_me']) && $params['only_me'] === 'true') ? true : false;
        $status = $params['status'] ?? 'all';

        $organizations = Organization::orderBy('sort')
            ->with('protocol')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($type, function ($query) use ($type) {
                return $query->where('type', $type);
            })->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })->when($onlyMe, function ($query) {
                return $query->where('salesman_id', auth('admin')->id());
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new OrganizationCollection($organizations);
    }

    /**
     * 获取机构详情
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $organization = Organization::find($id);

        return OrganizationResource::collection($organization);
    }

    /**
     * 新增机构
     * @param array $data
     * @return Organization|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        if (empty($data['added_at'])) {
            $data['added_at'] = now();
        }

        if (isset($data['images'])) {
            $data['images'] = \json_encode($data['images']);
        }

        return Organization::create($data);
    }

    /**
     * 更新机构
     * @param Organization $organization
     * @param $data
     * @return bool
     */
    public function update(Organization $organization, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $organization->update($data);
        }

        if (empty($data['added_at'])) {
            $data['added_at'] = now();
        }

        $data['images'] = \json_encode($data['images']);

        return $organization->update($data);
    }

    public function orders($orgId = null)
    {
        if (is_null($orgId)) {
            $orgId = $this->getOrganizationId();
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
        )->where('orders.from', User::FROM_ORGANIZATION)
            ->where('orders.from_id', $orgId)
//            ->leftJoin('users', function ($join) {
//                $join->on('users.id', '=', 'orders.user_id');
//            })->leftJoin('wechat_users', function ($join) {
//                $join->on('wechat_users.openid', '=', 'users.openid');
//            })
            ->join('activity_summer_camps', function ($join) {
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

    public function protocol($organizationId = null)
    {
        if (is_null($organizationId)) {
            $organizationId = $this->getOrganizationId();
        }

        return Protocol::where(['organization_id' => intval($organizationId)])->first();
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
            ->join('activity_summer_camps', function ($join) {
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
     * 获取到机构关联的机构列表
     */
    public function getChildOrganizations()
    {
        $orgId = $this->getOrganizationId();

        $list = Organization::select('id')->where('from', User::FROM_ORGANIZATION)
            ->where('from_id', $orgId)
            ->get();

        return $list;
    }
}
