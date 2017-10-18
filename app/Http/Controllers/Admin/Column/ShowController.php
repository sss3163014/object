<?php

namespace App\Http\Controllers\Admin\Column;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShowController extends Controller
{
    /**
     * 展示给定用户的信息。
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
    	return view('admin.column.index');
    }
}
