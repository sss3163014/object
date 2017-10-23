<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;


class ShowController extends Controller
{
   public function  index()
   {
      return view('home.index');
   }

   public function store(Request $request)
   {
      $tel = $request->input('tel');
      $password = md5($request->input('password'));

      $result = \DB::table('index_users_login')->where('login_name', $tel)->first();
      if (empty($result)) {
         return '帐号错误';
      }
      // dd($result->password);
      if ($password != $result->password) {
         return '密码错误';
      }
      
      //存入用户登陆信息
      $request->session()->put('user', $indexUserSql);
      //存入用户个人信息
      $request->session()->put('userInfo', $userinfoSql);

      return view('admin.column.index');
   } 
}
