<?php

namespace App\Services;

use App\ConsultLog;
use App\Http\Resources\ConsultLogCollection;
use App\Exceptions\ErrorException;

// ConsultLog
// 咨询日志
// $consultLogs

class ConsultLogService extends BaseService
{
    /**
     * 获取咨询日志列表
     * @param null $params
     * @return ConsultLogCollection
     */
    public function collection($params = null)
    {
        $activity_summer_camp_id = $params['activity_summer_camp_id'] ?? '';

        $consultLogs = ConsultLog::where('activity_summer_camp_id', $activity_summer_camp_id)
            ->orderBy('created_at')
            ->get();

        return new ConsultLogCollection($consultLogs);
    }

    /**
     * 获取咨询日志详情
     * @param $id
     * @return ConsultLogCollection
     */
    public function resource($id)
    {
        $consultLog = ConsultLog::find($id);

        return new ConsultLogCollection($consultLog);
    }

    /**
     * 新增咨询日志
     * @param array $data
     * @return ConsultLog|\Illuminate\Database\Eloquent\Model
     * @throws ErrorException
     */
    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return ConsultLog::create($data);
    }

    /**
     * 更新咨询日志
     * @param ConsultLog $consultLog
     * @param $data
     * @return bool
     */
    public function update(ConsultLog $consultLog, $data)
    {
        return $consultLog->update($data);
    }
}
