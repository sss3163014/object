<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
	/**
     *	后台首页显示
     *
     * @param  
     * @return 页面
     */
    public function index()
    {
    	return view('admin.show');
    }
}
