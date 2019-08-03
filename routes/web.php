<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/index',function(){
    return view("admin.index.index");
});


Route::get('/admin/Orders/delete/{id}','Admin\OrdersController@delete');
//后台 订单模块
Route::resource('/admin/Orders','Admin\OrdersController');

//后台 订单管理的添加页面
// Route::get('/admin/Orders/order_add','Admin\OrdersController@order_add');
//后他 订单管理的产看订单详情
Route::get('/admin/Orders/order_view/{id}','Admin\OrdersController@order_view');


// 后台 添加分类
// 后台 分类板块执行删除单个
Route::get('/admin/Sorts/delete/{id}','Admin\SortsController@delete');
// 后台 分类板块的批量删除
Route::GET('/admin/Sorts/pdelete/{id}','Admin\SortsController@pdelete');
// 后台 分类板块的添加
Route::GET('/admin/Sorts/create/','Admin\SortsController@create');
// 后台 分类版板块的添加子分类显示
Route::GET('/admin/Sorts/list/{id}','Admin\SortsController@list');
// 后台 分类板块的添加子分类
Route::POST('/admin/Sorts/list_add','Admin\SortsController@list_add');
// 后台 分类板块的分类名称的修改
Route::POST('/admin/Sorts/edit_update','Admin\SortsController@edit_update');
// 后台 分类板块的资源路由
Route::resource('/admin/Sorts','Admin\SortsController');



// 显示友情链接列表
Route::get('/admin/systems/links','Admin\SystemsController@links');
// 添加友情链接
Route::get('/admin/systems/links_create','Admin\SystemsController@links_create');
// 执行友情链接添加操作
Route::post('/admin/systems/links_store','Admin\SystemsController@links_store');
// 操作友情链接的状态
Route::post('/admin/systems/links_status','Admin\SystemsController@links_status');
// 编辑友情链接
Route::get('/admin/systems/links_edit/{id}','Admin\SystemsController@links_edit');
// 执行友情链接修改操作
Route::post('/admin/systems/links_update','Admin\SystemsController@links_update');
// 删除指定友情链接
Route::get('/admin/systems/links_del/{id}','Admin\SystemsController@links_del');
//批量删除友情链接
Route::post('/admin/systems/links_delAll','Admin\SystemsController@links_delAll');


// 显示商品列表
Route::get('/admin/goods/list','Admin\GoodsController@list');
// 显示添加商品页面
Route::get('/admin/goods/goods_create','Admin\GoodsController@goods_create');
//显示商品图片页面
Route::get('/admin/goods/goods_img/{id}','Admin\GoodsController@goods_img');
//执行上传商品图片操作
Route::post('/admin/goods/uploads','Admin\GoodsController@uploads');
//执行添加商品操作
Route::post('/admin/goods/goods_store','Admin\GoodsController@goods_store');
//显示商品编辑页面
Route::get('/admin/goods/goods_edit/{id}','Admin\GoodsController@goods_edit');
//执行商品修改操作
Route::post('/admin/goods/goods_update','Admin\GoodsController@goods_update');
//删除指定商品操作
Route::get('/admin/goods/goods_del/{id}','Admin\GoodsController@goods_del');
//批量删除商品
Route::post('/admin/goods/goods_delAll','Admin\GoodsController@goods_delAll');
// 后台网站配置
Route::get('/admin/webs/webs','Admin\webController@web');

// 后台用户列表
Route::get('/admin/user/userlist','Admin\UserController@user');
// 后台添加用户
Route::get('/admin/user/useradd','Admin\UserController@user_create');
// 执行用户添加
Route::post('/admin/user/user_store','Admin\UserController@user_store');

// 修改后台网站配置
Route::post('/admin/web/doweb','Admin\WebController@doweb');




// 前台 注册
Route::get('/home/register','Home\RegisterController@index');
// 前台 邮箱注册
Route::post('/home/register','Home\RegisterController@store');
// 前台 邮箱激活
Route::get('/home/register/changeemail','Home\RegisterController@changeemail');

// 前台邮箱激活提醒
Route::get('/home/activate',function(){
    return view('home.email.activate');
});

// 前台 手机号发送验证码
Route::get('/home/register/sendPhone','Home\RegisterController@sendPhone');
// 前台 手机号注册
Route::post('/home/register/phoneRegister','Home\RegisterController@phoneRegister');
// 前台登录
Route::get('/home/login','Home\LoginController@index');
Route::post('/home/login','Home\LoginController@login');


// 前台首页
Route::get('home/index','Home\IndexController@index');




