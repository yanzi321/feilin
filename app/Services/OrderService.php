<?php

namespace App\Services;

use App\ActivitySummerCamp;
use App\Order;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\Order as OrderResource;
use App\Exceptions\ErrorException;
use App\Product;
use App\User;
use Carbon\Carbon;

// Order
// 订单
//  $order
// $orders

class OrderService extends BaseService
{
    /**
     * 获取订单列表
     * @param null $params
     * @return OrderCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $order_sn = $params['order_sn'] ?? '';
        $from = $params['from'] ?? -1;
        $status = $params['status'] ?? -1;
        $user_tel = $params['user_tel'] ?? '';
        $user_name = $params['user_name'] ?? '';
        $created_at = $params['created_at'] ?? null;

        $orders = Order::orderByDesc('updated_at')
            ->when($order_sn, function ($query, $order_sn) {
                return $query->where('order_sn', 'like', "%$order_sn%");
            })
            ->when($from != -1, function ($query) use ($from) {
                return $query->where('from', $from);
            })
            ->when($status != -1, function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->when($created_at !== null, function ($query) use ($created_at) {
                $start_month = Carbon::createFromTimeString($created_at[0])->startOfMonth();
                $end_month = Carbon::createFromTimeString($created_at[1])->endOfMonth();
                $query->whereBetween('created_at', [$start_month, $end_month]);
            })
            ->when($user_tel, function ($query, $user_tel) {
                return $query->whereHas('user', function ($q) use ($user_tel) {
                    $q->where('tel', 'like', "%{$user_tel}%");
                });
            })
            ->when($user_name, function ($query, $user_name) {
                return $query->whereHas('user', function ($q) use ($user_name) {
                    $q->where('name', 'like', "%{$user_name}%");
                });
            })->with('user:id,name,tel,from')->when($all, function ($query) {
                return $query->get();
            })->with('product:id,name')->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new OrderCollection($orders);
    }

    /**
     * 获取订单详情
     * @param $id
     * @return OrderCollection
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $order = Order::find($id);

        return OrderResource::collection($order);
    }

    public function createAnDefaultOrderFromActivity(ActivitySummerCamp $activitySummerCamp)
    {
        $data = [
            'id' => 0,
            'activity_summer_camp_id' => $activitySummerCamp->id,
            'user_id' => intval($activitySummerCamp->user_id),
            'product_id' => 12, // 美国夏/冬令营项目
            'wants_country' => 'com', // 美国
            'total_fee' => 0,
            'status' => Order::IN_CONSULT_STATUS, // 咨询中
            'organization_id' => $activitySummerCamp->organization_id,
            'extern_salesman_id' => $activitySummerCamp->extern_salesman_id,
        ];

        return $this->store($data);
    }

    /**
     * 新增订单
     * @param array $data
     * @return Order|bool|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     * @throws \Throwable
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $from = User::FROM_PARTNER;

        // 如果来源是机构订单，需要更改 from 和 from_id
        $organization_id = 0;
        if (isset($data['organization_id'])) {
            if ($data['organization_id']) {
                $from = User::FROM_ORGANIZATION;
                $organization_id = $data['organization_id'];
            }
        }
        unset($data['organization_id']);

        // 如果来源是外部业务员，需要更改 from 和 from_id
        $extern_salesman_id = 0;
        if (isset($data['extern_salesman_id'])) {
            if ($data['extern_salesman_id']) {
                $from = User::FROM_EXTERN_SALESMAN;
                $extern_salesman_id = $data['extern_salesman_id'];
            }
        }
        unset($data['extern_salesman_id']);

        \DB::transaction(function () use ($data, $from, $organization_id, $extern_salesman_id) {
            $order = Order::create($data);
            $order->order_sn = $this->genOrderSN($order);

            // 获取用户信息
            $activitySummerCamp = $order->activitySummerCamp;
            $order->from = $from;

            if ($from == User::FROM_ORGANIZATION) {
                $order->from_id = $organization_id;
            } elseif ($from == User::FROM_EXTERN_SALESMAN) {
                $order->from_id = $extern_salesman_id;
            } else {
                $order->from_id = $activitySummerCamp->from_id;
            }

            // 获取产品信息
            $product = $order->product;
            $order->product_snapshot = $product->toJson();
            $order->commission = $product->commission;
            $order->left_fee = $order->total_fee;
            $order->paid_fee = 0;

            // 添加创建者信息 2019年04月18日11:21:26
            $order->admin_id = auth('admin')->id();

            $order->save();

            // 需要记录这个订单
            (new CommissionLogService())->addAnCommissionLog($order);
        });

        return true;
    }

    private function genOrderSN(Order $order)
    {
        $time = now()->format('Ymd');
        $random = strtoupper(str_random(5));
        $id = $order->id;

        return $time . $random . $id;
    }

    /**
     * 更新订单
     * @param Order $order
     * @param $data
     * @return bool
     */
    public function update(Order $order, $data)
    {
        // 用户信息
        if ($data['user_id'] != $order->user_id) {
            $user = User::find($data['user_id']);
            $order->from = $user->from;
            $order->from_id = $user->from_id;
            $order->user_id = $data['user_id'];
        }

        // 产品信息
        if ($data['product_id'] != $order->product_id) {
            $product = Product::find($data['product_id']);
            $order->product_snapshot = $product->toJson();
            $order->commission = $product->commission;
        }

        // 留学国家
        if ($data['wants_country'] != $order->wants_country) {
            $order->wants_country = $data['wants_country'];
        }

        // 修改价格
        if ($data['total_fee'] != $order->total_fee) {
            $order->total_fee = $data['total_fee'];
            $order->left_fee = $order->total_fee - $order->paid_fee;
        }

        // 修改状态
        if ($data['status']) {
            $order->status = $data['status'];
        }

        if ($data['product_id']) {
            $order->product_id = $data['product_id'];
        }

        // 需要记录这个订单
        (new CommissionLogService())->addAnCommissionLog($order);

        return $order->save();
    }

    public function detail(int $id)
    {
        $order = Order::with('activitySummerCamp')->with('product')->with('payLogs')->find($id);

        return $order;
    }

    public function getUserOrders(User $user)
    {
        $data = \DB::table('orders')->selectRaw(
            'orders.user_id as user_id, ' .
            'orders.id as order_id, ' .
            'orders.order_sn as order_sn, ' .
            'orders.status as order_status, ' .

            'products.id as product_id, ' .
            'products.name as product_name, ' .

            'wechat_users.nickname as user_nickname, ' .
            'wechat_users.avatar as user_avatar, ' .

            'admins.id as admin_id, ' .
            'admins.name as admin_name, ' .

            'sum(commission_logs.commission) as commission'
        )->where('orders.user_id', $user->id)
            ->leftJoin('users', function ($join) {
                $join->on('users.id', '=', 'orders.user_id');
            })->leftJoin('wechat_users', function ($join) {
                $join->on('wechat_users.openid', '=', 'users.openid');
            })->leftJoin('products', function ($join) {
                $join->on('orders.product_id', '=', 'products.id');
            })->leftJoin('admins', function ($join) {
                $join->on('orders.admin_id', '=', 'admins.id');
            })->leftJoin('commission_logs', function ($join) {
                $join->on('orders.id', '=', 'commission_logs.order_id');
            })->groupBy('orders.id')->get();

        return $data;
    }
}
