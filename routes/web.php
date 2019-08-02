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
