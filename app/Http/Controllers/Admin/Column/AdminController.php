<?php

namespace App\Http\Controllers\Admin\Column;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Model\Data_admin_users;
 
class AdminController extends Controller
{
    /**
     * 管理员权限。
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
    	$flights = data_admin_users::all();
        foreach ($flights as $flight) {
        echo $flight->tel;
        echo "&nbsp";
        echo $flight->nickname;
        echo '<br/>';
        }

        $user = data_admin_users::find(1);
        dd($user);


    }

    public function list()
    {

        return view();
        $array = data_users_type::paginate(3);
        dd($array);
       

        return view('admin.column.adminList', compact('array','userlist'));

    }

    
}
