<?php


namespace App\Models\Event;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Dysmsapi;

use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\AddSmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\DeleteSmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\ModifySmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\QuerySmsTemplateRequest;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\SendSmsRequest;
use App\Models\Basic\SmsRecord;
use App\Models\Basic\SmsTemplate;
use Darabonba\OpenApi\Models\Config;
use AlibabaCloud\SDK\Dysmsapi\V20170525\Models\AddSmsSignRequest;
use Illuminate\Support\Facades\Config as ConfigEnv;

class AliyunSms
{

    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return Dysmsapi Client
     */
    public static function createClient($accessKeyId, $accessKeySecret){
        $config = new Config([
            // 您的AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 您的AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new Dysmsapi($config);
    }

    /**
     * Notes: 发送短信
     * User: yanxianping
     * DateTime: 2021/5/8 9:30 上午
     */
    public static function sendSms($sendSms){
        $client = self::createClient(ConfigEnv::get('aliyun.sms.accessKeyId'), ConfigEnv::get('aliyun.sms.accessKeySecret'));

        $smsTemplate = SmsTemplate::where(['id'=>$sendSms['templateId']])->first();
        unset($sendSms['templateId']);

        $templateParam = $sendSms['templateParam'];
        $content = $smsTemplate->content;
        foreach ($templateParam as $key=>$value){
            $content = str_replace('${'.$key.'}',$value,$content);
        }

        $sendSms['templateCode'] = $smsTemplate->template_code;
        $sendSms['templateParam'] = json_encode($templateParam);
        $sendSms['signName'] = ConfigEnv::get('aliyun.sms.signName');



        $sendSmsRequest = new SendSmsRequest($sendSms);
        $response = $client->sendSms($sendSmsRequest);

        $response =  json_decode( json_encode( $response),true);

        SmsRecord::create([
            'phone' =>  $sendSms['phoneNumbers'],
            'states' => $response['body']['code'] == 'OK' ? 1:0,
            'content' => $content,
            'query' => json_encode($response),
        ]);

        return $response;
    }

    /**
     * Notes: 申请短信模版
     * User: yanxianping
     * DateTime: 2021/5/8 9:34 上午
     * @param $addSmsTemplate
     */
    public static function addSmsTemplate($addSmsTemplate){
        $client = self::createClient(ConfigEnv::get('aliyun.sms.accessKeyId'), ConfigEnv::get('aliyun.sms.accessKeySecret'));

        $addSmsTemplateRequest = new AddSmsTemplateRequest($addSmsTemplate);

        $response = $client->addSmsTemplate($addSmsTemplateRequest);
        $response =  json_decode( json_encode( $response),true);

        return $response;
    }

    /**
     * Notes: 查询短信模版的审核状态
     * User: yanxianping
     * DateTime: 2021/5/8 10:37 上午
     * @param $querySmsTemplate
     * @return mixed
     */
    public static function querySmsTemplate($querySmsTemplate){
        $client = self::createClient(ConfigEnv::get('aliyun.sms.accessKeyId'), ConfigEnv::get('aliyun.sms.accessKeySecret'));

        $querySmsTemplateRequest = new QuerySmsTemplateRequest($querySmsTemplate);

        $response = $client->querySmsTemplate($querySmsTemplateRequest);
        $response =  json_decode( json_encode( $response),true);

        return $response;
    }

    /**
     * Notes: 修改未通过审核的短信模版
     * User: yanxianping
     * DateTime: 2021/5/8 10:39 上午
     * @param $modifySmsTemplate
     * @return mixed
     */
    public static function modifySmsTemplate($modifySmsTemplate){
        $client = self::createClient(ConfigEnv::get('aliyun.sms.accessKeyId'), ConfigEnv::get('aliyun.sms.accessKeySecret'));

        $modifySmsTemplateRequest = new ModifySmsTemplateRequest($modifySmsTemplate);

        $response = $client->modifySmsTemplate($modifySmsTemplateRequest);
        $response =  json_decode( json_encode( $response),true);

        return $response;
    }

    /**
     * Notes: 删除短信模版
     * User: yanxianping
     * DateTime: 2021/5/8 10:52 上午
     * @param $deleteSmsTemplate
     * @return mixed
     */
    public static function deleteSmsTemplateRequest($deleteSmsTemplate){
        $client = self::createClient(ConfigEnv::get('aliyun.sms.accessKeyId'), ConfigEnv::get('aliyun.sms.accessKeySecret'));

        $deleteSmsTemplateRequest = new DeleteSmsTemplateRequest($deleteSmsTemplate);

        $response = $client->deleteSmsTemplate($deleteSmsTemplateRequest);
        $response =  json_decode( json_encode( $response),true);

        return $response;
    }
}
