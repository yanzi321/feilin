<?php

namespace App\Services;

use App\Exceptions\ErrorException;
use App\Models\Basic\OperationLog;

// ConsultLog
// 咨询日志
// $consultLogs

class OperationLogService
{
    /**
     * 获取咨询日志列表
     * @param null $params
     * @return ConsultLogCollection
     */
    public function collection($params = null)
    {

        $operationLogs = OperationLog::orderByDesc('created_at')
            ->paginate();

        return $operationLogs;
    }

}
