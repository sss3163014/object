<?php
use App\Model\data_basic_config;
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
//后台路由群
Route::group(['prefix' => 'admin', 'middleware' => 'login', 'namespace' => 'Admin'], function() {
	//后台首页路由
	Route::get('/', 'ShowController@index');
	//栏目列表路由
	Route::resource('list', 'Column\ShowController');
	//站点配置路由
	Route::resource('site', 'Site\ShowController');
	Route::post('site', 'Site\ShowController@putFile');
});

//跳转维护页面
Route::view('weihui', 'weihui');
//前台首页路由 
Route::get('/', function () {
    return view('home.index');
})->middleware('on_off');
//前台路由群
Route::group(['prefix' => 'home', 'namespace' =>'Home', 'middleware' => 'on_off'], function() {
	//手机验证路由 
	Route::post('land/code', 'LandController@doText');
	//登陆,注册页面路由
	Route::resource('land', 'LandController');
	//登陆验证路由
	Route::post('land/send', 'LandController@doLand');
	//注销路由
	Route::get('session','SessionController@index');
});