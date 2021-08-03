<?php

namespace App\Services;

use App\CommissionRule;
use App\Http\Resources\CommissionRuleCollection;
use App\Exceptions\ErrorException;

class CommissionRuleService extends BaseService
{
    /**
     * 获取佣金规则列表
     * @param null $params
     * @return CommissionRuleCollection
     */
    public function collection($params = null)
    {
        $all = $params['all'] ?? false;

        $commission_rules = CommissionRule::select(['id', 'stage', 'max_number', 'commission'])->orderBy('stage')
            ->when($all, function ($query) {
                return $query->get();
            })->when(!$all, function ($query) {
                return $query->paginate();
            });

        return new CommissionRuleCollection($commission_rules);
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        try {
            \DB::beginTransaction();
            foreach ($data as $rule) {
                $model = CommissionRule::find($rule['id']);
                if ($model) {
                    $model->update($rule);
                } else {
                    CommissionRule::create($rule);
                }
            }
            \DB::commit();
            return true;
        } catch (\Exception $exception) {
            \DB::rollBack();
            throw new ErrorException($exception->getMessage());
        }
    }
}
