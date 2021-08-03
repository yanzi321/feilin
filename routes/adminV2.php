<?php

Route::post('send-sms','SmsTemplateController@sendSms');
// 图片上传
Route::post('images', 'ImageController@upload');
Route::get('gen-sn/{id}', 'OrderController@genOrderSN');
//企业列表
Route::get('business-index', 'BusinessController@businessIndex');
Route::get('etemplateindex', 'ETemplateController@etemplateindex');
Route::get('agent-index', 'AgentController@agentIndex');
//审批详情
    // Route::resource('order-approval', 'OrderApprovalController');
// 导出
Route::get('export/{id}','ExcelController@excelExport');
/**
 * 后台需要 rbac 控制的各种权限
 */
Route::group([
    'middleware' => ['auth:admin', 'rbac'],
], function () {
    Route::resource('other', 'OtherController');
    //短信模版
    Route::resource('sms-template', 'SmsTemplateController');
    //短信记录
    Route::resource('sms-record', 'SmsRecordController');
    //e签宝模版
    Route::resource('e-template', 'ETemplateController');
    //经办人
    Route::resource('agent', 'AgentController');
    //
    Route::resource('business', 'BusinessController');
    //审批详情
    Route::resource('order-approval', 'OrderApprovalController');
    // 业务信息
    Route::resource('order', 'OrderController');
    //重新指向两个接口
    Route::get('index', 'OrderController@index')->name('transfer.index');
    Route::get('show/{id}', 'OrderController@show')->name('transfer.update');
    //撮合列表
    Route::resource('match', 'OrderMatchController');
    //应收款转让内容
    Route::resource('order-transfer', 'OrderTransferController');
    //审核业务
    Route::put('examine-order/{id}', 'OrderController@examineOrder')->name('order.examine_order');
    //审核企业
    Route::put('examine-business/{id}', 'BusinessController@examineBusiness')->name('business.examine_business');
    //添加次要联系人
    Route::post('secondary-contact', 'BusinessController@createContact')->name('business.create_contact');
    //编辑次要联系人
    Route::put('secondary-contact/{id}', 'BusinessController@updateContant')->name('business.update_contact');
    //删除次要联系人
    Route::delete('secondary-contact/{id}', 'BusinessController@delete')->name('business.delete_contact');
    //添加二次转让
    Route::put('make-over/{id}', 'OrderController@makeOver')->name('transfer.make_over');
    // //撮合列表
    // Route::get('match', 'BusinessController@match');
    // //添加撮合列表
    Route::post('match/{id}', 'BusinessController@addmatch')->name('match.addmatch');
    //审核审批
    Route::put('examin-approval/{id}', 'OrderApprovalController@examinApproval')->name('order-approval.examine-approval');
    //财务上传凭证，完成订单
    Route::put('loan/{id}', 'OrderApprovalController@loan')->name('order-approval.loan');


    //获取模版信息 签署区
    Route::get('doc-templates/{templateId}', 'ETemplateController@docTemplates')->name('e-template.doc');
    //查询模板详情/下载模板
    Route::get('do-template/{templateId}', 'ESaasController@docTemplates')->name('e-template.do');
    //通过模板创建文件
    Route::post('create-by-template', 'ESaasController@createByTemplate')->name('order.create-by-template');
    //一步发起签署
    Route::post('create-flow-one-step', 'ESaasController@createFlowOneStep')->name('order.create-flow-one-step');
    //获取下载文档地址
    Route::get('dowload-documents/{flow_id}', 'ESaasController@dowloadDocuments')->name('order.dowload-documents');
});
