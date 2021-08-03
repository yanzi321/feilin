<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Esign\Event;
use Illuminate\Http\Request;
use App\Models\Basic\ETemplate;
use App\Http\RequestsV2\ETemplateRequest;
use App\ServicesV2\ETemplateService;

class ETemplateController extends BaseController
{
    protected $service;

    public function __construct(ETemplateService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $doctor = $this->service->collection($request->all());

        return $this->success($doctor);
    }
    /**
     * 模板列表
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function etemplateindex(Request $request)
    {
        $etemplate = ETemplate::get()->toArray();

        return $this->success($etemplate);
    }

    public function store(ETemplateRequest $request)
    {

        $query = $this->service->store($request->all());

        if (is_object($query)) {
            return $this->success();
        }

        return $this->error($query);
    }

    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    public function update(ETemplateRequest $request, ETemplate $eTemplate)
    {
        if ($this->service->update($eTemplate, $request->all())) {
            return $this->success();
        }

        return $this->error();
    }

    public function docTemplates($templateId){

        $url = '/v1/docTemplates/'.$templateId;

        $event = new Event();
        $return = $event->getContent(json_encode([]),$url,'get');

        if($return['code'] != 0){
            return $this->error($return);
        }

        $write = [];
        //找到签署区
        foreach ($return['data']['structComponents'] as $value){
            if($value['type'] == 6){
                $write[] = [
                    'id' => $value['id'],
                    'label' => $value['context']['label'],
                    'type' => $value['type'],//1-单行文本，2-数字，3-日期，6-签约区，8-多行文本，11-图片
                    'pos' => json_encode($value['context']['pos']),
                ];
            }
        }

        return $this->success($write);
    }
}
