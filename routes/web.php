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


// 后台 添加分类
Route::get('/admin/Sorts/delete/{id}','Admin\SortsController@delete');
Route::GET('/admin/Sorts/pdelete/{id}','Admin\SortsController@pdelete');
// Route::get('/admin/Sorts','Admin\SortsController@index');

Route::resource('/admin/Sorts','Admin\SortsController');



// 显示友情链接列表
Route::get('/admin/systems/links','Admin\SystemsController@links');

// 添加友情链接
Route::get('/admin/systems/links_create','Admin\SystemsController@links_create');

// 执行友情链接添加操作
Route::post('/admin/systems/links_store','Admin\SystemsController@links_store');

