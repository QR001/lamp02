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


// 显示友情链接列表
Route::get('/admin/systems/links','Admin\SystemsController@links');

// 添加友情链接
Route::get('/admin/systems/links_create','Admin\SystemsController@links_create');

// 执行友情链接添加操作
Route::post('/admin/systems/links_store','Admin\SystemsController@links_store');

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




