<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\Event\AliyunSms;
use Illuminate\Http\Request;
use App\Models\Basic\SmsTemplate;
use App\Http\RequestsV2\SmsTemplateRequest;
use App\ServicesV2\SmsTemplateService;

class SmsTemplateController extends BaseController
{
    protected $service;

    public function __construct(SmsTemplateService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $list = SmsTemplate::where('states','<>',1)->pluck('template_code')->toArray();
//        $template_id = array_column($list,'template_id');
        if($list != NULL){
            foreach($list as $value){
                $query = AliyunSms::querySmsTemplate(['templateCode'=>$value]);
                SmsTemplate::where(['template_code'=>$value])->update([
                    'states' => $query['body']['templateStatus'],
                    'result' => json_encode($query),
                ]);
            }
        }
        $doctor = $this->service->collection($request->all());

        return $this->success($doctor);
    }

    public function store(SmsTemplateRequest $request)
    {
        $query = $this->service->store($request->all());
        if ($query) {

            $addSmsTemplate = [
                'templateType' => $request->type,
                'templateName' => $request->name,
                'templateContent' => $request->content,
                'remark' => $request->reason,
            ];
            $addSmsTemplateRequest = AliyunSms::addSmsTemplate($addSmsTemplate);
            SmsTemplate::where(['id'=>$query->id])->update(['template_code'=>$addSmsTemplateRequest['body']['templateCode']]);

            return $this->success();
        }

        return $this->error();
    }

    public function show($id)
    {
        $info = $this->service->show($id);
        return $this->success($info);
    }

    public function update(SmsTemplateRequest $request, SmsTemplate $smsTemplate)
    {

        //查询状态
        $query = AliyunSms::querySmsTemplate(['templateCode'=>$smsTemplate->template_code]);
        $this->service->update($smsTemplate,[
            'states' => $query['body']['templateStatus'],
            'result' => json_encode($query),
        ]);

        if($smsTemplate->states == 1 || $smsTemplate->states == 10)
            return $this->error('模版无法修改');

        $update = $request->all();
        $update['states'] = 0;
        if ($this->service->update($smsTemplate,$update)) {

            $modifySmsTemplate = [
                'templateType' => $smsTemplate->type,
                'templateName' => $smsTemplate->name,
                'templateContent' => $smsTemplate->content,
                'templateCode' => $smsTemplate->template_code,
                'remark' => $smsTemplate->reason,
            ];
            AliyunSms::modifySmsTemplate($modifySmsTemplate);
            return $this->success();
        }

        return $this->error();
    }

    public function destroy(SmsTemplate $smsTemplate){
        AliyunSms::deleteSmsTemplateRequest(['templateCode' => $smsTemplate->template_code,]);

        if ($smsTemplate->delete()) {
            return $this->success();
        }

        return $this->error();
    }


    public function sendSms(){

        $sendSms = [
            'phoneNumbers' => '1876167055',
            'templateId' => 1,
            'templateParam' => ["code"=>'12345'],  // 短信模板中字段的值
        ];

        AliyunSms::sendSms($sendSms);
    }
}
