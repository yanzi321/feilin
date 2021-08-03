<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\SmsRecordCollection;
use App\Models\Basic\SmsRecord;

class SmsRecordService
{

    public function collection($params = null)
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'desc';
        $states = isset($params['states']) ?$params['states']: '';

        $info = SmsRecord::orderBy('id',$sort)
            ->when($states!='', function ($query) use($states) {
                return $query->where('states',$states);
            })
            ->paginate($size);
//        $info = new SmsRecordCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        return SmsRecord::create($data);
    }

    public function update(SmsRecord $model, $data)
    {
        return $model->update($data);
    }

    public function show($id){

        $info = SmsRecord::where(['id'=>$id])->first();

        return $info;
    }
}
