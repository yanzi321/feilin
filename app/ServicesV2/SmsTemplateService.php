<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\SmsTemplateCollection;
use App\Models\Basic\SmsTemplate;
use App\Models\Event\AliyunSms;
use Darabonba\OpenApi\Models\Config;

class SmsTemplateService
{

    public function collection($params = null)
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'desc';
        $name = $params['name'] ?? '';
        $states = isset($params['states']) ?$params['states']: '';

        $info = SmsTemplate::orderBy('id',$sort)
            ->when($states!='', function ($query) use($states) {
                return $query->where('states',$states);
            })
            ->when($name!='', function ($query) use($name) {
                return $query->where('name','like','%'.$name.'%');
            })
            ->paginate($size);
//        $info = new SmsTemplateCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $query = SmsTemplate::create($data);


        return $query;
    }

    public function update(SmsTemplate $model, $data)
    {
        return $model->update($data);
    }

    public function show($id){

        $info = SmsTemplate::where(['id'=>$id])->first();

        return $info;
    }
}
