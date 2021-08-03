<?php

namespace App\Http\Controllers\FrontendV2;

use App\Models\Basic\Agent;
use App\Models\Basic\Business;
use App\Models\Basic\BusinessTemplateContent;
use App\Models\Basic\ETemplate;
use App\Models\Basic\ETemplateFile;
use App\Models\Basic\Order;
use App\Models\Basic\OrderLogs;
use App\Models\Esign\AccountID;
use App\Models\Esign\EToken;
use App\Models\Esign\Event;
use App\Models\Esign\SignFlows;
use App\Models\Esign\UploadUrl;
use App\Models\Event\Basic;
use App\Models\Event\Esign;
use Illuminate\Http\Request;
use DB;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Element\Chart;

class ESaasController extends BaseController{

    public function index(){

//        $json = [
//            "action"=>"SIGN_FLOW_FINISH",
//            "flowId"=>"af052c893f2d4f0691f97efc00dc910e",
//            "businessScence"=>"测试模版2",
//            "flowStatus"=>"2",
//            "createTime"=>"2021-05-24 15:42:57",
//            "endTime"=>"2021-05-24 15:48:08",
//            "statusDescription"=>"完成",
//            "timestamp"=>1621842489202
//        ];
//        $event = new Event();
//        $info = $event->getContent(json_encode($json),'http://zhongnan.com/api/frontendV2/esign-notify/flow/17');

        $token = new EToken();
        $stoken=$token->token();

        return $this->success($stoken);
    }

    /**
     * Notes: 创建个人签署账号
     * User: yanxianping
     * DateTime: 2021/5/11 11:12 上午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function businessAgentCreate(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'id_card' => 'required|identitycards',
            'mobile' => 'required|regex:/^1[3456789]\d{9}$/',
            'email' => 'required|email',
        ], [
            'name.required' => '姓名必填',
            'id_card.required' => '身份证必填',
            'id_card.identitycards' => '身份证格式错误',
            'mobile.required' => '手机号必填',
            'mobile.regex' => '手机号格式错误',
            'email.required' => '邮箱必填',
            'email.email' => '邮箱格式错误',
        ]);
        DB::beginTransaction();
        try {

            $data = $request->all();
            unset($data['type']);
            $type = $request->input('type',1);
            //1企业注册时添加经办人 2企业自主添加经办人 3平台添加经办人
            switch($type){
                case 1:
                    $info = Agent::where(['business_id'=>$request->info->id])->first();
                    if($info == NULL){
                        $data['business_id'] = $request->info->id;
                        $info = Agent::create($data);
                    }else{
                        $info->update($data);
                    }

                    //企业状态
                    $business = Business::where(['id'=>$request->info->id])->first();
                    if($business->is_certified != 1){
                        $business->update([
                            'is_certified'=>2,
                            'agent_certified' => 1
                        ]);
                    }
                    break;
                case 2:
                    $data['business_id'] = $request->info->id;
                    $info = Agent::create($data);
                    break;
            }

            $event = new Event();
            $return =  $event->agentCreate($info,$type);

            DB::commit();

            if($return['code'] == 0){
                return $this->success($return['data']);
            }else{
                return $this->error($return);
            }
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    /**
     * Notes: 注销个人与机构签署账号
     * User: yanxianping
     * DateTime: 2021/5/13 11:10 上午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function businessDelete(Request $request){

        $this->validate($request, [
            'id' => 'required',
            'states' => 'required|in:accounts,organizations',
        ], [
            'flow_id.required' => 'id必填',
            'states.required' => '状态必填',
            'states.in' => '状态必须是accounts或organizations',
        ]);

        //organizations机构
        //
        //
        //  个人
        $url = '/v1/'.$request->states.'/'.$request->id;

        $event = new Event();
        $return = $event->getContent(json_encode([]),$url,'delete');

        if($return['code'] == 0){
            return $this->success($return['data']);
        }else{
            return $this->error($return);
        }

    }

    /**
     * Notes: 创建机构签署账号
     * User: yanxianping
     * DateTime: 2021/5/11 2:15 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|string
     * @throws \Illuminate\Validation\ValidationException
     */
    public function businessCreate(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'identity' => 'required',
            'credit_code' => 'required',
            'legal_idcard.required' => '身份证必填',
            'legal_idcard.identitycards' => '身份证格式错误',
            'legal_tel' => 'required|regex:/^1[3456789]\d{9}$/',
            'legal_person' => 'required',
        ], [
            'name.required' => '企业名称必填',
            'identity.required' => '身份必填',
            'credit_code.required' => '统一社会信用代码必填',
            'legal_tel.required' => '手机号必填',
            'legal_tel.regex' => '手机号格式错误',
            'legal_person.required' => '法人姓名必填',
            'legal_idcard.required' => '身份证必填',
            'legal_idcard.identitycards' => '身份证格式错误',
        ]);

        $info = Business::where(['id'=>$request->info->id])->first();
        if($info == NULL){
            return $this->error();
        }
        DB::beginTransaction();
        try {

            $data = $request->all();
            $business_agent = Agent::where(['business_id'=>$request->info->id])->first();

            if($info->is_certified != 1){

                $info->update([
                    'identity' => $request->identity,
                    'is_certified'=>2,
                    'busines_certified' => 1
                ]);
            }

            $post = [
                'thirdPartyUserId' => 'business_'.$info->id,
                'creator' => $business_agent->account_id,
                'name' => $data['name'],
                'idNumber' => $data['credit_code'],
                'idType' => "CRED_ORG_USCC", //CRED_ORG_USCC统一社会信用代码  CRED_ORG_REGCODE工商注册号
                'orgLegalIdNumber' => $data['legal_idcard'],
                'orgLegalName' => $data['legal_person']
            ];

            $accountID = new AccountID();
            $orgId = $accountID->addOrganizeAccountID(json_encode($post));
            $data['org_id'] = $orgId;

            $invitations = [
                'inviteeOid' => $orgId, //被邀请人账号id，请先调用创建账号接口获取id，支持个人和机构
                'redirectURL' => env('FRONTEND_URL').'/#/manager',  //结束后重定向地址（需加前缀https:// 或 http:// ），默认停留在当前页面
                'callbackURL' => env('APP_URL').'/api/frontendV2/esign-notify/invitations/business_'.$info->id,  //回调接口地址，默认不回调
                'notifyType' => 'sms',
            ];
            $return = $accountID->createInvitations(json_encode($invitations));

            $info->update($data);
            DB::commit();
            return $this->success($return);
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Notes: 查询模板详情/下载模板
     * User: yanxianping
     * DateTime: 2021/5/12 11:46 上午
     * @param $templateId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function docTemplates($templateId,Request $request){

//        $templateId = '287e33c5eb6e4e1c971880954eb8139f';
        $url = '/v1/docTemplates/'.$templateId;

        $event = new Event();
        $return = $event->getContent(json_encode([]),$url,'get');

        if($return['code'] != 0){
            return $this->error($return);
        }

        $write = [];
        foreach ($return['data']['structComponents'] as $value){
            if($value['context']['required'] == true){
                $write[] = [
                    'id' => $value['id'],
                    'label' => $value['context']['label'],
                    'type' => $value['type'],//1-单行文本，2-数字，3-日期，6-签约区，8-多行文本，11-图片
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

        $this->validate($request, [
            'scene' => 'required',
            'template_id' => 'required',
            'order_id' => 'required',
        ], [
            'name.required' => '名称必填',
            'template_id.required' => '模版id必填',
            'order_id.required' => '订单id必填',
        ]);

        $order = Order::where(['id'=>$request->order_id])->first();
        $template = ETemplate::where(['id'=>$request->template_id])->first();
        if($order == NULL || $template == NULL){
            return $this->error('无法创建模版，请重试');
        }

        if($order->state != 0 && $order->state != 1){
            return $this->error('该状态无法创建模版');
        }


        $url = '/v1/files/createByTemplate';
        $data = [
            'name' =>  $request->scene,
            'templateId' => $template->template_id,
            'simpleFormFields' => $request->write,
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
                    'scene' => $request->scene,
                    'template_id' => $template->id,
                    'file_id' => $return['fileId'],
                    'state' => 1,
                ]);

                $content = new BusinessTemplateContent();
                foreach ($request->write as $key=>$value){
                    $content->create([
                        'key' => $key,
                        'value' => $value,
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
     * Notes: 签署流程创建
     * User: yanxianping
     * DateTime: 2021/5/12 3:20 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signFlows(Request $request){

        $this->validate($request, [
            'name' => 'required',
        ], [
            'name.required' => '文件主题必填',
        ]);

        $preg = "/[*<>?:\"\/]/";
        if(preg_match($preg, $request->name)){
            return $this->error('不支持/\:*"<>|?');
        }

        $url = '/v1/signflows';
        $data = [
            'autoArchive' => true,
            'businessScene' =>  $request->name,
            'configInfo' => [
                'noticeType' => 1,
            ],
//            'initiatorAccountId' => '',//发起人账户id，即发起本次签署的操作人个人账号id；如不传，默认由对接平台发起
//            'initiatorAuthorizedAccountId' => '',//发起方主体id，如存在个人代机构发起签约，则需传入机构id；如不传，则默认是对接平台
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0){
            $return = $return['data'];
            //"flowId" => "47d680b33ed448998e90ffca9061c331"

            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 流程文档添加
     * User: yanxianping
     * DateTime: 2021/5/12 3:43 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signFlowDocuments(Request $request){
        $this->validate($request, [
            'flow_id' => 'required',
            'file_id' => 'required',
        ], [
            'flow_id.required' => '流程id必填',
            'file_id.required' => '文档id必填',
        ]);

        $url = '/v1/signflows/'.$request->flow_id.'/documents';
        $data = [
            'docs' => [
                [
                    'fileId' => $request->file_id,
                ]
            ],
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0){
            $return = $return['data'];
            //"fileId" => "10534e37b27a4c2aa9f137f4a29e25cd"

            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 添加平台方自动盖章签署区
     * User: yanxianping
     * DateTime: 2021/5/12 4:14 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signFlowPlatformSign(Request $request){
        $this->validate($request, [
            'flow_id' => 'required',
            'file_id' => 'required',
        ], [
            'flow_id.required' => '流程id必填',
            'file_id.required' => '文档id必填',
        ]);

        $url = '/v1/signflows/'.$request->flow_id.'/signfields/platformSign';
        $data = [
            'signfields'=>[ //签署区列表数据
                [
                    'order' => '1',   //签署顺序，默认1,且不小于1，顺序越小越先处理
                    'fileId' => $request->file_id,  //文件file id
//                    'sealId' => 'e6ecb2fd-e4ec-4c04-be97-85c3d46a960e', //印章id， 仅限企业公章，暂不支持指定企业法定代表人印章
                    'signType' => '1',  //签署类型， 1-单页签署，2-骑缝签署，默认1
                    'posBean' => [   //签署区位置信息, （signType为1时, 页码和XY坐标不能为空, signType为2时, 页码和Y坐标不能为空）
                        'posPage' => '1',   //页码信息，当签署区signType为2时, 页码可以'-'分割, 其他情况只能是数字
                        'posX' => '200',    //x坐标，默认空
                        'posY' => '200',    //y坐标
                    ]
                ]
            ]
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0) {
            $return = $return['data'];
            //"fileId" => "10534e37b27a4c2aa9f137f4a29e25cd"
//{
//    "code": 200,
//    "msg": "success",
//    "data": {
//        "signfieldBeans": [
//            {
//                "signfieldId": "75c59679534a4d799f8bcc191da9b597",
//                "fileId": "10534e37b27a4c2aa9f137f4a29e25cd",
//                "accountId": "5ad117c963b2479e94342a76f954881f"
//            }
//        ],
//    }
//}
            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 添加签署方手动盖章签署区
     * User: yanxianping
     * DateTime: 2021/5/12 6:24 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signFlowHandSign(Request $request){
        $this->validate($request, [
            'flow_id' => 'required',
            'file_id' => 'required',
            'signer_account_id' => 'required',
        ], [
            'flow_id.required' => '流程id必填',
            'file_id.required' => '文档id必填',
            'signer_account_id.required' => '经办人必填',
        ]);

        $url = '/v1/signflows/'.$request->flow_id.'/signfields/handSign';
        $data = [
            'signfields'=>[ //签署区列表数据
                [
                    'order' => '1',   //签署顺序，默认1,且不小于1，顺序越小越先处理
                    'fileId' => $request->file_id,  //文件file id
                    'signerAccountId' => $request->signer_account_id,  //签署操作人个人账号标识，即操作本次签署的个人，如需e签宝通知用户签署，则系统向该账号下绑定的手机、邮箱发送签署链接
                    'authorizedAccountId' => $request->authorized_account_id,  //签约主体账号标识，即本次签署对应任务的归属方，如传入机构id，则签署完成后，本任务可在企业账号下进行管理，默认是签署操作人个人
                    'actorIndentityType' => '2', //机构签约类别，当签约主体为机构时必传：2-机构盖章，3-法定代表人盖章 ；
//                    'sealId' => 'e6ecb2fd-e4ec-4c04-be97-85c3d46a960e', //印章id， 仅限企业公章，暂不支持指定企业法定代表人印章
                    'signType' => '1',  //签署类型， 1-单页签署，2-骑缝签署，默认1
                    'posBean' => [   //签署区位置信息, （signType为1时, 页码和XY坐标不能为空, signType为2时, 页码和Y坐标不能为空）
                        'posPage' => '1',   //页码信息，当签署区signType为2时, 页码可以'-'分割, 其他情况只能是数字
                        'posX' => '200',    //x坐标，默认空
                        'posY' => '200',    //y坐标
                    ]
                ]
            ]
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0) {
            $return = $return['data'];
            //"fileId" => "10534e37b27a4c2aa9f137f4a29e25cd"

//{
//    "code": 200,
//    "msg": "success",
//    "data": {
//        "signfieldBeans": [
//            {
//            "signfieldId": "a1ff79e4d7b6432499b3459c7c5aef0b",
//            "fileId": "10534e37b27a4c2aa9f137f4a29e25cd",
//            "accountId": "21824d982faf497c84de1bcda3451c35"
//            }
//        ],
//        "post_url": "https://smlopenapi.esign.cn/v1/signflows/47d680b33ed448998e90ffca9061c331/signfields/handSign"
//    },
//}
            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 签署流程修改
     * User: yanxianping
     * DateTime: 2021/5/13 9:52 上午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signFlowsStates(Request $request){

        $this->validate($request, [
            'flow_id' => 'required',
            'states' => 'required|in:start,revoke',
        ], [
            'flow_id.required' => '流程id必填',
            'states.required' => '状态必填',
            'states.in' => '状态必须是start或revoke',
        ]);

        $url = '/v1/signflows/'.$request->flow_id.'/'.$request->states;
        $data = [];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url,'put');

        if($return['code'] == 0){
            $return = $return['data'];
            //"flowId" => "47d680b33ed448998e90ffca9061c331"

            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: 获取签署流程列表
     * User: yanxianping
     * DateTime: 2021/5/13 10:35 上午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function processesList(Request $request){

        $url = '/v2/open/processes/list';
        $flowStatus = 2;    //签署流程状态。其他状态暂不支持 2-已完成（流程完结）
        $flowTimeFrom = strtotime($request->input('start_time','1970-01-01 08:00:01')) * 1000;   //查询流程列表的开始时间，默认时间戳，单位：毫秒
        $flowTimeTo = strtotime($request->input('end_time','2099-12-31 23:59:59')) * 1000;     //查询流程列表的完成时间，默认时间戳，单位：毫秒
        $pageNo = $request->input('page',1);        //分页页码，最小为1
        $pageSize = $request->input('pageSize',20);      //每页数量，默认20，最大100

        $url = $url.'?flowStatus='.$flowStatus.'&flowTimeFrom='.$flowTimeFrom.'&flowTimeTo='.$flowTimeTo.'&pageNo='.$pageNo.'&pageSize='.$pageSize;

        $event = new Event();
        $return = $event->getContent(json_encode([]),$url,'get');

        if($return['code'] == 0){
            $return = $return['data'];
            //"flowId" => "47d680b33ed448998e90ffca9061c331"

            return $this->success($return);
        }else{
            return $this->error($return);
        }
    }

    /**
     * Notes: e签宝回调
     * User: yanxianping
     * DateTime: 2021/5/20 2:29 下午
     * @param $type
     * @param $key
     * @param Request $request
     * @return false|string
     */
    public function notify($type,$key,Request $request){
//        $data = [
//            'inviteeInfo' => [
//                'orgIdNumber' => '91320411MA1NMQPMXN',
//                'idType' => 'CRED_PSN_CH_IDCARD',
//                'orgName' => '常州木凡创意设计有限公司',
//                'orgIdType' => 'CRED_ORG_USCC',
//                'name' => '揭珉怡',
//                'mobile' => '18015832569',
//                'idNumber' => '360602199010221068',
//                'inviteeOid' => 'aa386f4c26df43f1a0959809051f9000',
//                'orgId' => 'orgId',
//            ],
//            'invitationId' => '64d0c7dcc0f34fb48b0f49efac256858',
//            'status' => '2'
//        ];

        $body = file_get_contents("php://input");
        $result = json_decode($body,true);

        DB::beginTransaction();
        try {

            switch($type){
                //邀请
                case 'invitations':
                    if(strpos($key,'_agent_')){
                        $id = str_replace('business_agent_','',$key);
                        $agent = Agent::find($id);
                        if($agent->business_id != 0){
                            $business = Business::where(['id'=>$agent->business_id])->first();
                            if($business->busines_certified == 2){
                                $update['is_certified'] = 1;
                            }
                            $update['agent_certified'] = 2;
                            $business->update($update);
                        }
                        $agent->update(['states'=>1]);
                    }else{
                        $id = str_replace('business_','',$key);
                        $business = Business::where(['id'=>$id])->first();
                        if($business->agent_certified == 2){
                            $update['is_certified'] = 1;
                        }
                        $update['busines_certified'] = 2;
                        $business->update($update);
                    }
                    break;
                case 'flow':
                    $order = Order::where(['id'=>$key])->first();
                    if($order == NULL){
                        return $this->error();
                    }

                    //任务状态：2-已完成: 所有签署人完成签署；3-已撤销: 发起方撤销签署任务；5-已过期: 签署截止日到期后触发；7-已拒签
                    if($result['flowStatus'] == 2){
                        $order->update([
                            'status' => 4,
                            'examine_status' => 7,
                        ]);
                        //添加日志
                    OrderLogs::insert([
                        'order_id' => $order->id,
                        'type' => '1',
                        'operation_id' => $agent->id,
                        'operation_role' => '经办人',
                        'operation_name' => $agent->name,
                        'operation' => '签署了合同',
                        'field_name' => '',
                        'old_data' => '',
                        'new_data' => '',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    }

                break;
            }

            DB::commit();

            return json_encode(['code'=>200]);
        }catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
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
            $signfields = [
                [
                    'fileId' => $file_id,     //待签署文件id
                    'actorIndentityType' => '2',    //企业主体签约类型：2-机构盖章； 注： 1、签署主体是个人时，无需传入该参数，传入会导致无法正常签署 2、签署主体是企业时，该字段必传，传入2
                    'signType' => '1',  //签署类型，0-不限，1-单页签署，2-骑缝签署，默认1
                    'posBean' => [      //签署区位置信息  signType为0时，本参数无效 signType为1时, 页码和XY坐标不能为空 signType为2时, 页码和Y坐标不能为空
                        'posPage' => $pos['page'],    //页码信息，当签署区signType为2时, 页码可以'-'分割指定页码范围, 其他情况只能是数字
                        'posX' => $pos['x'],   //x坐标，坐标为印章中心点
                        'posY' => $pos['y'],   //y坐标，坐标为印章中心点
                    ]
                ],
            ];

            switch($value['sign']){
                //甲方
                case 1:
                    $signers[] = [
                        'platformSign' => false, //是否平台方自动签署，默认false true-平台方自动签署 false-平台用户签署
                        'signerAccount' => [    //签署方账号信息（平台方自动签署时，无需传入该参数）
                            'signerAccountId' => $platform->account_id,    //签署操作人个人账号标识，即操作本次签署的个人 注：平台用户自动签署时，该参数需要传入签署主体账号id。
                            'authorizedAccountId' => config('eSaas.authorizedAccountId'),    //签约主体账号标识，即本次签署对应任务的归属方，默认是签署操作人个人 注：平台用户自动签署时，无需传入该参数
                        ],
                        'signfields' => $signfields,
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
                        'signfields' => $signfields,
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
            ],
            'signers' => $signers,//本次签署流程添加的签署区的列表信息,
        ];

        $event = new Event();
        $return = $event->getContent(json_encode($data),$url);

        if($return['code'] == 0){
            $return = $return['data'];
            //"flowId" => "47d680b33ed448998e90ffca9061c331"

            $order->update([
                'platform_agent_id' => $platform_agent_id,
                'flow_id' => $return['flowId'],
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

    /**
     * Notes: 修改机构签署账号信息
     * User: yanxianping
     * DateTime: 2021/5/20 2:29 下午
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function businessUpdate(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'identity' => 'required',
            'legal_idcard' => 'required|identitycards',
            'legal_person' => 'required',
        ], [
            'name.required' => '企业名称必填',
            'identity.required' => '身份必填',
            'legal_person.required' => '法人姓名必填',
            'legal_idcard.required' => '身份证必填',
            'legal_idcard.identitycards' => '身份证格式错误',
        ]);

        $url = '/v1/organizations/updateByThirdId';

        $data = [
            'thirdPartyUserId' => 'business_'.$request->info->id,
            'name' =>  $request->name,
            'orgLegalIdNumber' =>  $request->legal_idcard,
            'orgLegalName' =>  $request->legal_person,
        ];
        DB::beginTransaction();
        try {

            $business = Business::where(['id'=>$request->info->id])->first();
            if($business == NULL){
                return $this->error('公司不存在');
            }

            $business->update($request->all());

            $event = new Event();
            $return = $event->getContent(json_encode($data),$url);

            DB::commit();
            return $this->success($return);
        }catch (\Exception $e) {
            DB::rollBack();
            return $this->error($e->getMessage());
        }
    }

    public function word($id){
        $order = Order::with(['agentInfo','businessInfo'])->where(['id'=>$id])->first();
        $reply_no=$this->getreplyno($id);
        $tmp = new TemplateProcessor(public_path().'/stub/approvalTemplate.docx');
        //获取客户经理
        $orderlogs=OrderLogs::where(['order_id'=>$id,'operation_role'=>'客户经理'])->first();
        //编号
        $tmp->setValue('no', $reply_no);
        //申报客户经理
        $tmp->setValue('accountManager', $orderlogs->operation_name);
        //日期
        $tmp->setValue('date', date('Y-m-d'));
        //融资主体
        $tmp->setValue('company', $order->businessInfo['name']);
        //融资金额
        $tmp->setValue('amount', $order->money);
        //收款主体开户行
        $tmp->setValue('bank', $order->businessInfo['open_bank']);
        //收款主体账号
        $tmp->setValue('bankAccount', $order->businessInfo['public_accunt']);
        //业务品种
        $tmp->setValue('breed', $order->order_type);
        //放款利率
        $tmp->setValue('percentage', $order->rate);
        //融资主体
        // $tmp->setValue('company2', '1');
        $businessterm=$order->start_time.'至'.$order->end_time;
        //业务期限
        $tmp->setValue('businessTerm', $businessterm);
        //担保方式
        $tmp->setValue('warrant', $order->vouch_for);
        //批复时间
        $tmp->setValue('dateReply', now());
        //保理公司批复意见
        //获取利息
        $days=$this->diffBetweenTwoDays($order->end_time,now());
        $tempdays=$days+4;
        $rate_money=$order->money*$tempdays*$order->rate/360;
        $rate_money=sprintf("%.2f",$rate_money);
        $f_rate=0.07;
        $fuwu=$order->money*$tempdays*$f_rate/360;
        $f_rate=sprintf("%.2f",$f_rate);
        //获取手续费
        $opinion='同意操作'.$order->businessInfo['name'].$order->order_type.'，对'.$order->businessInfo['name'].'有限公司放款'.$order->money.'元，利息金额'.$rate_money.'元，手续费金额'.$f_rate.'元。';
        $tmp->setValue('opinion', $opinion);
        //最后内容
        $tmp->setValue('content', '2121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·2131132121312·213113');
        $url = "/storage/".Basic::getRandomString(16).".docx";
        $path = public_path().$url;
        //另存为
        $tmp->saveAs($path);

        return $this->success(['url'=>env('APP_URL').$url]);

    }
    public function getreplyno($id){
        $order=Order::find($id);
        if (!$order->id) {
            return false;
        }
        if ($order->reply_no) {
            return $order->reply_no;
        }
        $orders=Order::orderby('reply_no','desc')->limit(1)->get()->toArray();
        if (!$orders || $orders[0]['reply_no']=='null') {
            $xuhao='001';
        }else{
            if (intval(substr($orders[0]['reply_no'],strlen($orders[0]['reply_no'])-3,3))==0) {
                $xuhao='001';
            }else{
                $xuhao=substr($orders[0]['reply_no'],-3)+1;
                $xuhao = sprintf("%03d",$xuhao);
            }

        }

        // 获取编号
        $year=date('Y');
        $month=date('m');

        $id = $order->id;
        $orderdata['reply_no']=$year . $month . $xuhao;
        $info = $order->update($orderdata);
        return $orderdata['reply_no'];

    }
    public function diffBetweenTwoDays ($day1, $day2)
    {
      $second1 = strtotime($day1);
      $second2 = strtotime($day2);
        
      if ($second1 < $second2) {
        $tmp = $second2;
        $second2 = $second1;
        $second1 = $tmp;
      }
      return intval(($second1 - $second2) / 86400);
    }
}
