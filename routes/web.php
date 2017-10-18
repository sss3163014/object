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

//后台路由
Route::group(['prefix' => 'admin'], function() {
	//后台首页
	Route::get('/', 'Admin\Column\ShowController@show');
});

//前台路由
/*Route::group(['prefix' => 'home'], function() {

});*/