<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\data_users_post;
use App\Model\data_users_type;

class IndexController extends Controller
{
   

    public function opt(Request $request){
    		$id = $request->has('id') ? $request['id'] : '1';
    		$array = data_users_post::where('type_id',$request['id'])->get();
    		return $array;
    }
}
