<?php

namespace App\Services;

use App\Admin;
use App\Http\Resources\OrderCollection;
use App\Order;
use App\Product;
use App\Role;
use App\Salesman;
use App\User;
use Carbon\Carbon;

class ReportService extends BaseService
{
    public function orders($params = null)
    {
        $order_sn = $params['order_sn'] ?? '';
        $tel = $params['tel'] ?? '';
        $user_name = $params['user_name'] ?? '';

        $orders = Order::orderByDesc('updated_at')
            ->when($order_sn, function ($query, $order_sn) {
                return $query->where('order_sn', 'like', "%$order_sn%");
            })->when($tel, function ($query, $tel) {
                return $query->whereHas('user', function ($q) use ($tel) {
                    $q->where('tel', 'like', "%{$tel}%");
                });
            })->when($user_name, function ($query, $user_name) {
                return $query->whereHas('user', function ($q) use ($user_name) {
                    $q->where('name', 'like', "%{$user_name}%");
                });
            })->with('user:id,sex,age,name,tel')
            ->paginate();

        return new OrderCollection($orders);
    }


    public function products($params = null)
    {
        $name = $params['name'] ?? '';

        $products = Product::orderBy('name')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%{$name}%");
            })->with('orders')->get();

        $products = $products->map(function ($product) {
            /**
             * @var Product $product
             */
            $product->total_fee = $product->orders->sum('total_fee');

            // 佣金计算的规则修改了 2019年04月05日11:15:50
            // 变成阶段性的，见 commission_rules
//            $product->commission = $product->orders->map(function ($order) {
//                /**
//                 * @var Order $order
//                 */
//                return $order->total_fee * $order->commission / 100;
//            })->sum();

            return $product;
        });

        return $products;
    }

    public function salesmen($params = null)
    {
        $name = $params['name'] ?? '';

        $salesmen = Salesman::orderBy('name')
            ->when($name, function ($query, $name) {
                $query->where('name', 'like', "%{$name}%");
            })->get();

        $salesmen = $salesmen->map(function ($salesman) {
            $salesman->orderTemp = $salesman->orders->filter(function ($order) {
                return $order->from == User::FROM_SALESMAN;
            });

            /**
             * @var Salesman $salesman
             */
            $salesman->total_fee = $salesman->orderTemp->sum('total_fee');

            // 佣金计算的规则修改了 2019年04月05日11:15:50
            // 变成阶段性的，见 commission_rules
//            $salesman->commission = $salesman->orderTemp->map(function ($order) {
//                return $order->paid_fee * $order->commission / 100;
//            })->sum();

            return $salesman;
        });

        return $salesmen;
    }

    public function summary($params = null)
    {
        $total_fee = Order::sum('total_fee');

        $salesmen_count = Admin::count();
        $customers_count = User::count();

        return compact('total_fee', 'salesmen_count', 'customers_count');
    }

    public function order_count($params)
    {
        $type = $params['type'] ?? null;

        if ($type == 'weekly') {
            return $this->order_weekly_report();
        }

        return Order::when($type == 'last_week', function ($query) {
            $query->where('created_at', '>', Carbon::today()->subDays(7)->toDateString());
        })->count();
    }

    /**
     * 近一周订单报告
     */
    private function order_weekly_report()
    {
        $orders = Order::select('id', 'created_at')
            ->where('created_at', '>', Carbon::today()->subDays(7)->toDateString())
            ->orderBy('created_at', 'ASC')
            ->get();

        $daysOrders = $orders->map(function ($order) {
            /**
             * @var Order $order
             */
            $order->dayOfWeek = $order->created_at->dayOfWeek;
            return $order;
        })->sortBy('dayOfWeek')->groupBy('dayOfWeek');

        // 这里的数据是不包含为 0 的数据的
        $data = [];
        foreach ($daysOrders as $dayOrders) {
            $count = count($dayOrders);
            $dayOfWeek = $dayOrders[0]['dayOfWeek'];
            $week_zh = week_zh($dayOfWeek);
            $data[$week_zh] = [
                'count' => $count,
                'dayOfWeek' => $dayOfWeek,
                'week' => $week_zh
            ];
        }

        // 构造七天都为 0 的数组
        $fillData = [];
        foreach (range(0, 6) as $day) {
            $week_zh = week_zh($day);
            $fillData[$week_zh] = ['count' => 0, 'dayOfWeek' => $day, 'week' => $week_zh];
        }

        // 合并空和非空数组
        $dataWithEmptyDay = array_merge($fillData, $data);

        // 格式化输出
        $countArr = [];
        $weekArr = [];
        foreach ($this->sortFromToday($dataWithEmptyDay) as $data) {
            $countArr[] = $data['count'];
            $weekArr[] = $data['week'];
        }

        return compact('countArr', 'weekArr');
    }

    /**
     * 从今天开始排序
     * @param $fromMonday
     * @return array
     */
    private function sortFromToday($fromMonday)
    {
        // 使用当前日作为开始
        $today = week_zh(Carbon::today()->dayOfWeek);
        $tmp = [];
        $start = false;
        foreach ($fromMonday as $day => $data) {
            if ($start == true) {
                $tmp[$day] = $data;
            }

            if ($day == $today) {
                $start = true;
            }
        }

        $start = true;
        foreach ($fromMonday as $day => $data) {
            if ($start == true) {
                $tmp[$day] = $data;
            }

            if ($day == $today) {
                $start = false;
            }
        }

        return $tmp;
    }

    public function order_amount($params)
    {
        $type = $params['type'] ?? null;

        return Order::when($type == 'last_week', function ($query) {
            $query->where('created_at', '>', Carbon::today()->subDays(7)->toDateString());
        })->sum('total_fee');
    }

    public function salesman_count()
    {
        $role_id = Role::select('id')->where('name', 'salesman')->first()->id;

        $salesman_count = \DB::table('role_user')->where('role_id', $role_id)->count();

        return $salesman_count;
    }

    public function customer_count()
    {
        return User::count();
    }

    public function partner_count()
    {
        return User::where('is_partner', 1)->where('partner_status', 1)->count();
    }
}
