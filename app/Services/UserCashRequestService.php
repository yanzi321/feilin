<?php

namespace App\Services;

use App\UserCashRequest;
use App\Http\Resources\UserCashRequestCollection;
use App\Http\Resources\UserCashRequest as UserCashRequestResource;
use App\Exceptions\ErrorException;

// UserCashRequest
// 提现申请
//  $user_cash_request
// $user_cash_requests

class UserCashRequestService extends BaseService
{
    /**
     * 获取提现申请列表
     * @param null $params
     * @return UserCashRequestCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;
        $name = $params['name'] ?? '';

        $user_cash_requests = UserCashRequest::orderBy('status')->orderBy('updated_at')
            ->with('user:id,nickname,avatar')
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new UserCashRequestCollection($user_cash_requests);
    }

    public function resource($id)
    {
        $user_cash_request = UserCashRequest::with('user')->find($id);

        return $user_cash_request;
    }

    /**
     * 新增提现申请
     * @param array $data
     * @return UserCashRequest|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return UserCashRequest::create($data);
    }

    /**
     * 更新提现申请
     * @param UserCashRequest $user_cash_request
     * @param $data
     * @return bool
     */
    public function update(UserCashRequest $user_cash_request, $data)
    {
        if ($this->isSwitchStatus($data)) {
            return $user_cash_request->update($data);
        }

        return $user_cash_request->update($data);
    }
}
