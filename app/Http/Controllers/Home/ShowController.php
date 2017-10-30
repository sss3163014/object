<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class ShowController extends Controller
{
	/**
     * 网站首页显示
     *
     * @param  int  $id
     * @return 页面
     */
   	public function  index()
   	{
       	return view('home.index');
   	}

}
