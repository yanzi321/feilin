<?php

//登陆
Route::post('login','AuthController@login');
Route::any('esign-notify/{type}/{key}','ESaasController@notify');
 //转让内容列表
Route::get('transfer', 'OrderTransferController@index');
//发送验证码
Route::post('send-sms', 'BasicController@sendSms');
//发送验证码
Route::post('check-code', 'BasicController@checkCode');
Route::post('forgetpassword', 'UserController@forgetPassword');
// 需要登录后才能访问
Route::group(['middleware' => 'frontend.login'], function () {
    //添加我的品类
    Route::post('column', 'UserColumnController@store');
    //删除我的类目
    Route::delete('column/{id}', 'UserColumnController@delete');
    //我的品类列表
    Route::get('column', 'UserColumnController@index');
    //修改企业信息
    Route::get('user', 'UserController@detail');
    Route::put('user', 'UserController@update');
    //添加生词
    Route::post('newword', 'UserNewWordController@store');
    //生词列表
    Route::get('newword', 'UserNewWordController@index');
    //生词详情
    Route::get('newword/{id}', 'UserNewWordController@show');
    //删除生词
    Route::delete('newword/{id}', 'UserNewWordController@delete');
    //新增其他联系人
    Route::post('toocontacts', 'UserController@toocontacts');
    //修改其他联系人
    Route::put('toocontacts/{id}', 'UserController@updateContant');
    //删除其他联系人
    Route::delete('toocontacts/{id}', 'UserController@delete');
    //文章列表
    Route::get('article', 'ArticleController@article');
    //文章详情
    Route::get('article/{id}', 'ArticleController@show');
    //添加阅读列表
    Route::post('read', 'UserReadController@store');
    //阅读列表
    Route::get('read', 'UserReadController@index');
    //一键阅读全部
    Route::post('readarticle', 'UserReadController@readArticle');
    //添加笔记
    Route::post('readnote', 'ReadNoteController@store');
    //笔记列表
    Route::get('readnote', 'ReadNoteController@index');
    //添加分享
    Route::post('share', 'UserShareController@store');
    Route::delete('share/{id}', 'UserShareController@delete');
    //添加点赞
    Route::post('like', 'UserLikeController@store');
    Route::delete('like/{id}', 'UserLikeController@delete');
    //添加收藏
    Route::post('enshrine', 'UserEnshrineController@store');
    Route::delete('enshrine/{id}', 'UserEnshrineController@delete');
    //系统消息
    Route::get('system', 'UserMessageController@index');
    Route::get('system/{id}', 'UserMessageController@show');
    //标记全部已读
    Route::put('readsystem', 'UserMessageController@readSystem');
    //修改密码
    Route::post('editpassword', 'UserController@editPassword');
    

});
