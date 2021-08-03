<?php

namespace App\Services;

use App\ActivitySummerCamp;
use App\Http\Resources\ActivitySummerCampCollection;
use App\Http\Resources\ActivitySummerCamp as ActivitySummerCampResource;
use App\Exceptions\ErrorException;
use App\Mail\NewActivity;


class ActivitySummerCampService extends BaseService
{
    /**
     * 获取夏令营活动列表
     * @param null $params
     * @return ActivitySummerCampCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';
        $tel = $params['tel'] ?? '';
        $wants_country = $params['wants_country'] ?? '';
        $from = $params['from'] ?? '';

        $activity_summer_camps = ActivitySummerCamp::orderByDesc('created_at')
            ->with('partner:id,nickname')
            ->with('order.product')
            ->with('organization:id,name')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($tel, function ($query, $tel) {
                return $query->where('tel', 'like', "%$tel%");
            })->when($wants_country, function ($query, $wants_country) {
                return $query->where('wants_country', 'like', "%$wants_country%");
            })->when($from, function ($query, $from) {
                return $query->where('from', $from);
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new ActivitySummerCampCollection($activity_summer_camps);
    }

    /**
     * 获取夏令营活动详情
     * @param $id
     * @return ActivitySummerCampCollection
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function resource($id)
    {
        $activity_summer_camp = ActivitySummerCamp::find($id);

        return ActivitySummerCampResource::collection($activity_summer_camp);
    }

    /**
     * 新增夏令营活动
     * @param array $data
     * @return ActivitySummerCamp|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        // 如果有机构信息，需要识别来源
        if (isset($data['org'])) {
            if ($data['org']) {
                $data['organization_id'] = \Crypt::decrypt(
                    urldecode($data['org'])
                );
            }
        }
        unset($data['org']);

        // 如果有外部业务员信息
        if (isset($data['extern_salesman'])) {
            if ($data['extern_salesman']) {
                $data['extern_salesman_id'] = \Crypt::decrypt(
                    urldecode($data['extern_salesman'])
                );
            }
        }
        unset($data['extern_salesman']);

        $data['ip'] = request()->ip();

        $user = session('user');
        if ($user) {
            $data['user_id'] = $user->id;
        }

        $activitySummaryCamp = ActivitySummerCamp::create($data);

        if (!$activitySummaryCamp) {
            throw new ErrorException('报名失败，请重试');
        }


        try {
            if (!app()->isLocal()) {
                // 新的报名，需要发送消息
                \Mail::to('global_group@steptousa.com')->send(new NewActivity($activitySummaryCamp));
            } else {
                \Mail::to('rovast@163.com')->send(new NewActivity($activitySummaryCamp));
            }
        } catch (\Exception $exception) {

        }

        // 手动添加一个订单
        (new OrderService())->createAnDefaultOrderFromActivity($activitySummaryCamp);

        return $activitySummaryCamp;
    }

    /**
     * 更新夏令营活动
     * @param ActivitySummerCamp $activity_summer_camp
     * @param                    $data
     * @return bool
     */
    public function update(ActivitySummerCamp $activity_summer_camp, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $activity_summer_camp->update($data);
        }

        return $activity_summer_camp->update($data);
    }
}
