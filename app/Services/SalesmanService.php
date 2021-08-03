<?php

namespace App\Services;

use App\Admin;
use App\Order;
use App\Salesman;
use App\Http\Resources\SalesmanCollection;
use App\Http\Resources\Salesman as SalesmanResource;
use App\Exceptions\ErrorException;
use App\User;

// Salesman
// 业务员
//  $salesman
// $salesmen

class SalesmanService extends BaseService
{
    /**
     * 获取业务员列表
     * @param null $params
     * @return SalesmanCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $salesmen = Admin::orderBy('name')
            ->whereRoleIs('salesman')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new SalesmanCollection($salesmen);
    }

    /**
     * 获取业务员详情
     * @param $id
     * @return SalesmanCollection
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $salesman = Salesman::find($id);

        return SalesmanResource::collection($salesman);
    }

    /**
     * 新增业务员
     * @param array $data
     * @return Salesman|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return Salesman::create($data);
    }

    /**
     * 更新业务员
     * @param Salesman $salesman
     * @param $data
     * @return bool
     */
    public function update(Salesman $salesman, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $salesman->update($data);
        }

        return $salesman->update($data);
    }

    /**
     * 获取到该业务员的所有用户列表
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function customers($id)
    {
        $customers = User::where('from', User::FROM_SALESMAN)
            ->where('from_id', $id)->get();

        return $customers;
    }

    public function orders($id)
    {
        $orders = Order::whereHas('user', function ($query) use ($id) {
            $query->where('from', User::FROM_SALESMAN)->where('from_id', $id);
        })->with('user')->get();

        return $orders;
    }
}
