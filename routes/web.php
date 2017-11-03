<?php
use App\Model\data_users_type;

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
//注销路由
Route::post('admin/del', 'Admin\LoginController@doDel');
//后台路由群
Route::group(['prefix' => 'admin', 'middleware' =>  ['login','hasRole'], 'namespace' => 'Admin'], function() {
	//后台首页路由
	Route::get('/', 'ShowController@index');
	//栏目列表路由
	Route::resource('list', 'Column\ShowController');
	//站点配置路由
	Route::resource('site', 'Site\ShowController');
	Route::post('site', 'Site\ShowController@putFile');

	//用户模块
	Route::resource('user','User\UserController');
	Route::post('ban/{id}','User\UserController@ban');
	Route::get('auth/{id}','User\UserController@auth');
	Route::post('doauth','User\UserController@doauth');

	//帖子显示
	Route::get('post', 'Post\PostController@index');
	//帖子编辑
	Route::post('post/edit', 'Post\PostController@store');
	//帖子编辑首页
	Route::get('post/editindex', 'Post\PostController@edit');
	//帖子删除
	Route::get('post/del', 'Post\PostController@destroy');
	//帖子修改
	Route::get('post/update', 'Post\PostController@update');
	//帖子状态更改
	Route::get('post/way', 'PostController@way');

	//角色列表
	Route::post('roleList/fsave', 'RoseController@fsave');
	Route::resource('roleList', 'RoseController');
	//权限列表
	Route::post('permissionList/fsave', 'PermissionController@fsave');
	Route::resource('permissionList', 'PermissionController');

	// 友情连接
	Route::resource('/link', 'FriendshipLink\LinkController');

	// 广告
	Route::resource('/GuangGao', 'GuangGao\GuangGaoController');
});
//如果没有权限，给一个没有权限的提示页面
	Route::get('admin/nopermission',function(){
    return view('errors.permission');
	});

//跳转维护页面
Route::view('weihui', 'weihui');
//前台首页路由 
Route::get('/', function () {
	$result = data_users_type::all();
	return view('home.index',compact('result'));
})->middleware('on_off');
Route::get('/opt', 'IndexController@opt');
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

	// 前台帖子列表
	Route::get('post','PostController@index');
	//前台帖子详情
	Route::get('postshow','PostController@postshow');

	Route::get('postdel','PostController@destroy');

	// 个人中心
	Route::get('user_home' ,'user\UserController@show_home');
	Route::get('mypost','user\UserController@mypost');
	Route::get('myreply','user\UserController@myreply');
	Route::get('collection','user\UserController@collection');
	Route::get('mypic','user\UserController@mypic');
	Route::post('dopic','user\UserController@dopic');

});