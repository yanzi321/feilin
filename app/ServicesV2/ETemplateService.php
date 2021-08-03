<?php

namespace App\ServicesV2;

use App\Exceptions\ErrorException;
use App\Http\ResourcesV2\ETemplateCollection;
use App\Models\Basic\BusinessTemplateSign;
use App\Models\Basic\ETemplate;
use DB;

class ETemplateService
{

    public function collection($params = null)
    {

        $size = $params['pageSize'] ?? 10;
        $sort = $params['sort'] ?? 'desc';

        $info = ETemplate::orderBy('id',$sort)
            ->paginate($size);
//        $info = new ETemplateCollection($info);

        return $info;
    }

    public function store(array $data)
    {
        if (empty($data)) {
            throw new ErrorException('got empty data');
        }

        $write = $data['write'];
        unset($data['write']);

        DB::beginTransaction();
        try {
            $info = ETemplate::create($data);

            foreach ($write as $key=>$value){

                $sign_key = $value['sign'];
                $sign[$sign_key] = $sign_key;
                $content[] = [
                    'template_id' => $info->id,
                    'key' => $value['id'],
                    'pos' => $value['pos'],
                    'value' => json_encode($value),
                    'sign' => $sign_key
                ];

            }
            if(isset($sign[1]) && isset($sign[2])){
                BusinessTemplateSign::insert($content);
                DB::commit();
                return $info;
            }else{
                DB::rollBack();
                return '签署区必须有甲乙双方';
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

    }

    public function update(ETemplate $model, $data)
    {
        $write = $data['write'];
        unset($data['write']);

        DB::beginTransaction();
        try {
            $info = $model->update($data);
            BusinessTemplateSign::where(['template_id'=>$model->id])->delete();

            foreach ($write as $key=>$value){
                $sign_key = $value['sign'];
                $sign[$sign_key] = $sign_key;
                $content[] = [
                    'template_id' => $model->id,
                    'key' => $value['id'],
                    'pos' => $value['pos'],
                    'value' => json_encode($value),
                    'sign' => $sign_key
                ];
            }

            if(isset($sign[1]) && isset($sign[2])){
                BusinessTemplateSign::insert($content);
                DB::commit();
                return $info;
            }else{
                DB::rollBack();
                return '签署区必须有甲乙双方';
            }

        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function show($id){

        $info = ETemplate::with(['tmplateSign'])->where(['id'=>$id])->first()->toArray();

        foreach ($info['tmplate_sign'] as $value){
            $change[] = json_decode($value['value'],true);
        }

        $info['tmplate_sign'] = $change;

        return $info;
    }
}
