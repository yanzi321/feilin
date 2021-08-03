<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| 后台管理系统相关
|
*/

// 用户登录、退出、刷新认证信息
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('info', 'AuthController@info');
});


Route::post('admin/login', 'AuthController@login');
Route::get('admin/info', 'AdminController@info');
Route::get('categorieslist', 'CategoryController@categorieslist');

/**
 * 有些路由，暂时还没有做权限控制，那就直接放开，不然功能会异常的
 */
Route::group(['middleware' => 'auth:admin'], function () {
    Route::put('roles/{role}/permissions', 'RoleController@updatePermissions');
    Route::get('permissions/group', 'PermissionController@group');
    Route::get('orders/{order}/detail', 'OrderController@detail')->name('orders.detail');
    Route::get('salesmen/{id}/customers', 'SalesmanController@customers')->name('salesmen.customers');
    Route::get('salesmen/{id}/orders', 'SalesmanController@orders')->name('salesmen.orders');
    Route::get('report/summary', 'ReportController@summary')->name('report.summary');
    Route::get('report/order_count', 'ReportController@order_count')->name('report.order_count');
    Route::get('report/order_amount', 'ReportController@order_amount')->name('report.order_amount');
    Route::get('report/salesman_count', 'ReportController@salesman_count')->name('report.salesman_count');
    Route::get('report/partner_count', 'ReportController@partner_count')->name('report.partner_count');
    Route::get('report/customer_count', 'ReportController@customer_count')->name('report.customer_count');

    // 图片上传
    Route::post('images', 'ImageController@upload');
    // 协议上传
    Route::post('protocols', 'ProtocolController@upload');
    Route::put('protocols', 'ProtocolController@update');

    Route::resource('consult_logs', 'ConsultLogController');
    Route::resource('orders', 'OrderController');
    Route::resource('pay_logs', 'PayLogController');
    Route::resource('activity_summer_camps', 'ActivitySummerCampController');

    // 外部业务员 2019年11月13日17:25:38
    Route::resource('extern_salesmen', 'ExternSalesmanController');
});

/**
 * 后台需要 rbac 控制的各种权限
 */
Route::group(['middleware' => ['auth:admin', 'rbac']], function () {
    // 管理员相关
    Route::resource('admins', 'AdminController');

    // 角色相关
    Route::resource('roles', 'RoleController');

    // 权限相关接口
    Route::resource('permissions', 'PermissionController');

    // 分类相关
    Route::resource('categories', 'CategoryController');

    // 文章标签
    Route::resource('tags', 'TagController');

    // 文章
    Route::resource('articles', 'ArticleController');

    // 碎片模型
    Route::resource('pieceModels', 'PieceModelController');

    // 碎片
    Route::resource('pieces', 'PieceController');

    // 注册用户管理
    Route::resource('users', 'UserController');

    Route::resource('products', 'ProductController');

    Route::resource('product_categories', 'ProductCategoryController');

    Route::resource('organizations', 'OrganizationController');

    Route::resource('salesmen', 'SalesmanController');

    Route::resource('user_cash_requests', 'UserCashRequestController');

    Route::resource('commission_rules', 'CommissionRuleController');
    //日志相关
    Route::resource('operation_log', 'OperationLogController');

    // 报告相关
    Route::get('report/orders', 'ReportController@orders')->name('report.orders');
    Route::get('report/products', 'ReportController@products')->name('report.products');
    Route::get('report/salesmen', 'ReportController@salesmen')->name('report.salesmen');
});

