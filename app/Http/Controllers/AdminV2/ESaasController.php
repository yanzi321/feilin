<?php


namespace App\Http\Controllers\AdminV2;


use App\Models\Basic\Agent;
use App\Models\Basic\BusinessTemplateContent;
use App\Models\Basic\ETemplate;
use App\Models\Basic\Order;
use App\Models\Basic\OrderLogs;
use App\Models\Esign\Event;
use Illuminate\Http\Request;
use DB;

class ESaasController extends BaseController
{

    /**
     * Notes: 查询模板详情/下载模板
     * User: yanxianping
     * DateTime: 2021/5/12 11:46 上午
     * @param $templateId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function docTemplates($templateId,Request $request){

        $name = $request->route()->getName();
//        $templateId = '287e33c5eb6e4e1c971880954eb8139f';
        $url = '/v1/docTemplates/'.$templateId;

        $event = new Event();
        $return = $event->getContent(json_encode([]),$url,'get');

        if($return['code'] != 0){
            return $this->error($return);
        }

        $write = [];
        foreach ($return['data']['structComponents'] as $value){
            if($value['context']['required'] == true  && $value['type'] != 6) {
                $write[] = [
                    'id' => $value['id'],
                    'label' => $value['context']['label'],
                    'type' => $value['type'],//1-单行文本，2-数字，3-日期，6-签约区，8-多行文本，11-图片
                    'required' => $value['context']['required'],
                    'limit' => $value['context']['limit'],
                    'ext' => $value['context']['ext']
                ];
            }
        }

        return $this->success($write);

    }

    /**
     * Notes: 通过模板创建文件
     * User: yanxianping
     * DateTime: 2021/5/11 4:23 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createByTemplate(Request $request){

//        $data = [
//            'name' => '测试', //模板编号
//            'templateId' => '287e33c5eb6e4e1c971880954eb8139f',
//            'simpleFormFields' => [
//                'ac46a2fc71f4406f9510ae8e4f789c49' => '甲方',
//                'f95d329fda024e7f80fb2131cb114309' => '乙方',
//                '06f07df705734f7496bb317600fbd0c9' => '2021/01/01',
//                'b6a5a2045a2a4584a2f212860b06e07d' => '2021/01/02'
//            ],
//        ];
//       //获取当前人员的信息
        $user = auth('admin')->user();
        $this->validate($request, [
            'name' => 'required',
            'template_id' => 'required',
            'order_id' => 'required',
        ], [
            'name.required' => '名称必填',
            'template_id.required' => '模版id必填',
            'order_id.required' => '订单id必填',
        ]);

        $order = Order::where(['id'=>$request->order_id])->first();
        $template = ETemplate::where(['template_id'=>$request->template_id])->first();
        if($order == NULL || $template == NULL){
            return $this->error('无法创建模版，请重试');
        }

        if($order->state != 0 && $order->state != 1){
            return $this->error('该状态无法创建模版');
        }

        $write = [];
        foreach ($request->write as $value){
            $write[$value['id']] = $value['sign'];
        }


        $url = '/v1/files/createByTemplate';
        $data = [
            'name' =>  $request->name,
            'templateId' => $request->template_id,
            'simpleFormFields' => $write,
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);
        DB::beginTransaction();
        try {
            if($return['code'] == 0){
                $return = $return['data'];
                //            ETemplateFile::create([
                //                'template_id' => $request->template_id,
                //                'file_name' => $return['fileName'],
                //                'file_id' => $return['fileId'],
                //                'download_url' => $return['downloadUrl'],
                //            ]);

                $order->update([
                    'scene' => $request->name,
                    'template_id' => $template->id,
                    'file_id' => $return['fileId'],
                    'state' => 1,
                    'status' => 3,
                    'examine_status' => 6,
                    'initiation_time' => now(),
                ]);
                //添加日志
                OrderLogs::insert([
                    'order_id' => $order->id,
                    'type' => '2',
                    'operation_id' => $user->id,
                    'operation_role' => $user->role_name,
                    'operation_name' => $user->name,
                    'operation' => '发起合同',
                    'field_name' => '',
                    'old_data' => '',
                    'new_data' => '',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $content = new BusinessTemplateContent();
                foreach ($request->write as $value){
                    $content->create([
                        'key' => $value['id'],
                        'value' => $value['sign'],
                        'file_id' => $return['fileId'],
                    ]);
                }


                DB::commit();
                return $this->success($return);
            }else{
                DB::rollBack();
                return $this->error($return);
            }

        }catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Notes: 一步发起签署
     * User: yanxianping
     * DateTime: 2021/5/18 3:32 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function createFlowOneStep(Request $request){
        $this->validate($request, [
            'order_id' => 'required',
            'platform_agent_id' => 'required',
        ], [
            'order_id.required' => '订单必填',
            'platform_agent_id.required' => '平台经办人必填',
        ]);

        $order = Order::with(['agentInfo','businessInfo'])->where(['id'=>$request->order_id])->first();
        if($order->state != 1 ){
            if($order->state == 0){
                return $this->error('请选选择合同模版');
            }

            return $this->error('无法生成合同模版');
        }

        $file_id = $order->file_id;
        //签署经办人
        $agent_id = $order->agentInfo->account_id;
        //签署公司
        $org_id = $order->businessInfo->org_id;
        //平台经办人
        $platform_agent_id = $request->platform_agent_id;
        $platform = Agent::where(['id'=>$platform_agent_id])->first();
        //模版
        $template_info = ETemplate::with(['tmplateSign'])->where(['id'=>$order->template_id])->first();
        if($template_info == NULL){
            return $this->error('模版不存在');
        }
        $template_info = $template_info->toArray();

        foreach($template_info['tmplate_sign'] as $value){

            $pos = str_replace('\"','"',json_decode($value['value'],true)['pos']);
            $pos = json_decode($pos,true);
            $posBean = [      //签署区位置信息  signType为0时，本参数无效 signType为1时, 页码和XY坐标不能为空 signType为2时, 页码和Y坐标不能为空
                'posPage' => $pos['page'],    //页码信息，当签署区signType为2时, 页码可以'-'分割指定页码范围, 其他情况只能是数字
                'posX' => $pos['x'],   //x坐标，坐标为印章中心点
                'posY' => $pos['y'],   //y坐标，坐标为印章中心点
            ];
            $signfields = [
                [
                    'fileId' => $file_id,     //待签署文件id
                    'actorIndentityType' => '2',    //企业主体签约类型：2-机构盖章； 注： 1、签署主体是个人时，无需传入该参数，传入会导致无法正常签署 2、签署主体是企业时，该字段必传，传入2
                    'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                    'posBean' => $posBean
                ],
            ];

            if($value['sign'] == 3 || $value['sign'] == 4){
                unset($signfields[0]['actorIndentityType']);
            }

            switch($value['sign']){
                //甲方
                case 1:
                    $signers[] = [
                        'platformSign' => true, //是否平台方自动签署，默认false true-平台方自动签署 false-平台用户签署
                        'signerAccount' => [    //签署方账号信息（平台方自动签署时，无需传入该参数）
                            'signerAccountId' => $platform->account_id,    //签署操作人个人账号标识，即操作本次签署的个人 注：平台用户自动签署时，该参数需要传入签署主体账号id。
//                            'authorizedAccountId' => '5ad117c963b2479e94342a76f954881f',    //签约主体账号标识，即本次签署对应任务的归属方，默认是签署操作人个人 注：平台用户自动签署时，无需传入该参数
                        ],
                        'signfields' => [
                            [
                                'autoExecute' => true,  //是否自动执行签署，默认false
                                'fileId' => $file_id,     //待签署文件id
                                'actorIndentityType' => '2',    //企业主体签约类型：2-机构盖章； 注： 1、签署主体是个人时，无需传入该参数，传入会导致无法正常签署 2、签署主体是企业时，该字段必传，传入2
                                'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                                'posBean' => $posBean
                            ],
                        ],
                    ];
                    break;
                //甲方法人
                case 3:
                    $signers[] = [
                        'platformSign' => false, //是否平台方自动签署，默认false true-平台方自动签署 false-平台用户签署
                        'signerAccount' => [    //签署方账号信息（平台方自动签署时，无需传入该参数）
                            'signerAccountId' => $platform->account_id,    //签署操作人个人账号标识，即操作本次签署的个人 注：平台用户自动签署时，该参数需要传入签署主体账号id。
//                            'authorizedAccountId' => '5ad117c963b2479e94342a76f954881f',    //签约主体账号标识，即本次签署对应任务的归属方，默认是签署操作人个人 注：平台用户自动签署时，无需传入该参数
                        ],
                        'signfields' => [
                            [
                                'fileId' => $file_id,     //待签署文件id
                                'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                                'posBean' => $posBean
                            ],
                        ],
                    ];
                    break;
                //乙方
                case 2:
                    $signers[] = [
                        'platformSign' => false, //是否平台方自动签署，默认false true-平台方自动签署 false-平台用户签署
                        'signerAccount' => [    //签署方账号信息（平台方自动签署时，无需传入该参数）
                            'signerAccountId' => $agent_id,    //签署操作人个人账号标识，即操作本次签署的个人 注：平台用户自动签署时，该参数需要传入签署主体账号id。
                            'authorizedAccountId' => $org_id,    //签约主体账号标识，即本次签署对应任务的归属方，默认是签署操作人个人 注：平台用户自动签署时，无需传入该参数
                        ],
                        'signfields' =>  [
                            [
                                'fileId' => $file_id,     //待签署文件id
                                'actorIndentityType' => '2',    //企业主体签约类型：2-机构盖章； 注： 1、签署主体是个人时，无需传入该参数，传入会导致无法正常签署 2、签署主体是企业时，该字段必传，传入2
                                'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                                'posBean' => $posBean
                            ],
                        ],
                    ];
                    break;
                //乙方法人
                case 4:
                    $signers[] = [
                        'platformSign' => false, //是否平台方自动签署，默认false true-平台方自动签署 false-平台用户签署
                        'signerAccount' => [    //签署方账号信息（平台方自动签署时，无需传入该参数）
                            'signerAccountId' => $agent_id,    //签署操作人个人账号标识，即操作本次签署的个人 注：平台用户自动签署时，该参数需要传入签署主体账号id。
//                            'authorizedAccountId' => $org_id,    //签约主体账号标识，即本次签署对应任务的归属方，默认是签署操作人个人 注：平台用户自动签署时，无需传入该参数
                        ],
                        'signfields' =>  [
                            [
                                'fileId' => $file_id,     //待签署文件id
                                'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                                'posBean' => $posBean
                            ],
                        ],
                    ];
                    break;
            }

        }

        $url = '/api/v2/signflows/createFlowOneStep';

        $data = [

//            'copiers' => [      //抄送人人列表 可空
//                [
//                    'copierAccountId' => $platform_agent_id,    //参与人account id
//                    'copierIdentityAccountType' => '0',     //参与主体类型, 0-个人, 1-企业, 默认个人
//                ],
//            ],
            'docs' => [        //待签署文件信息
                [
                    'fileId' => $file_id,     //待签署文件id
                ],
            ],
            'flowInfo' => [     //本次签署流程的基本信息
                'businessScene' => $order->scene,      //本次签署流程的主题名称
                'autoArchive' => true,    //是否自动归档，默认false
                'autoInitiate' => true,    //是否自动开启，默认false
                'initiatorAccountId' => $platform->account_id,   //发起人账户id，即发起本次签署的操作人个人账号id；如不传，默认由对接平台发起
//                'initiatorAuthorizedAccountId' => '',     //发起方主体id，如存在个人代机构发起签约，则需传入机构id；如不传，则默认是对接平台
                'flowConfigInfo' => [       //本次签署流程的任务信息配置
                    'noticeDeveloperUrl' => env('APP_URL').'/api/frontendV2/esign-notify/flow/'.$request->order_id,     //通知开发者地址。
                    'noticeType' => '1,2',      //签署通知方式， 默认方式：1。同时支持多种通知方式，用逗号分割。1-短信，2-邮件。
//                    'redirectUrl' => '',        //签署完成后，重定向跳转地址（http/https）。
                ],
            ],
            'signers' => $signers,//本次签署流程添加的签署区的列表信息,
        ];
//dd(json_encode($data));
        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0){

            //"flowId" => "47d680b33ed448998e90ffca9061c331"

            $order->update([
                'platform_agent_id' => $platform_agent_id,
                'flow_id' => $return['data']['flowId'],
                'state' => 2,
            ]);

            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 获取下载文档地址
     * User: yanxianping
     * DateTime: 2021/5/18 3:26 下午
     * @param $flow_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function dowloadDocuments($flow_id){

        $url = '/v1/signflows/'.$flow_id.'/documents';
        $data = [];
        $event = new Event();
        $return = $event->getContent(json_encode($data),$url,'get');

        return $this->success($return);
    }
}
