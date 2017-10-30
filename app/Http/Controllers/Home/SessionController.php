<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    /**
     * 注销操作
     *
     * @param  int  $id
     * @return 
     */
    public function index()
    {
    	session()->forget('user');
    	session()->forget('userInfo');
    	return back();
    }
}
