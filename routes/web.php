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
//验证码路由
Route::get('admin/captcha/{tmp}', 'Admin\LoginController@captcha');
//后台登陆路由
Route::resource('admin/login', 'Admin\LoginController');
//后台路由
Route::group(['prefix' => 'admin', 'middleware' => 'login' ,'namespace' => 'Admin'], function() {
	//后台首页
	Route::get('/', 'Column\ShowController@index');
	//栏目列表显示
	//Route::post('list', 'ShowController');
	Route::get('list', 'Column\ShowController@index');
	//管理员权限页面
	Route::get('admin', 'Column\AdminController@show');
	//管理员列表页面
	Route::get('adminList', 'Column\AdminController@list');
});



//前台首页
Route::get('/', function () {
    return view('home.index');
});
//前台路由
Route::group(['prefix' => 'home', 'namespace' =>'Home'], function() {
	//前台页面
	Route::resource('/', 'ShowController');
	//手机验证
	Route::post('land/code', 'LandController@doText');
	//登陆,注册页面
	Route::resource('land', 'LandController');
	//登陆验证
	Route::post('land/send', 'LandController@doLand');
});