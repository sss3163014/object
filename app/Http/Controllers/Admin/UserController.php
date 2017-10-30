<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Model\index_users_login;
use App\Model\data_users_register;
use App\Model\data_users_info;
use App\Model\blog_role;



use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('keywords')) {
           $input = trim($request->input('keywords')) ;

           $list =\DB::table("data_users_info")->orderBy('user_id','desc')->where('nickname','like','%'.$input.'%')->paginate(3);
           return view('admin.user.list',['users' => $list, 'keys' =>$input ]); 
        }else{
            $input = '';
            $list = \DB::table('data_users_info')->orderBy('user_id','desc')->paginate(3);
            return view('admin.user.list',['users' => $list, 'keys' =>$input ]); 
        }
       
    
    }	

    public function create()
    {
        return  view('admin.user.add');
    }
     public function store(Request $request)
    {
      $input = $request ->all();
      $data_users_register = new data_users_register;
      $data_users_register -> tel = $input['phone'];
      $data_users_register -> password = $input['pwd'];
      $res = $data_users_register->save();

      $index_users_login = new index_users_login;
      $index_users_login->user_id = $data_users_register-> id;
      $index_users_login->login_name = $input['name'];
      $index_users_login->password = $input['pwd'];
      $re = $index_users_login->save();

      $data_users_info = new data_users_info;
      $data_users_info->user_id = $data_users_register-> id;
      $data_users_info->tel = $input['phone'];
      $re1 = $data_users_info->save();
    
      if($res && $re && $re1) {
        return view('admin.user.add')->with('ems','添加成功');
      } else{
        return back()->with('mes','添加失败');
      }
      
    }

    public function auth($id)
    {   
        
        
       $user = index_users_login::where('user_id',$id)->first();
       $roles = blog_role::all();
       
      // $own_roles = \DB::table('blog_user_role')->where('user_id',$id)->lists('role_id');
        $own_roles = DB::table('blog_user_role')->where('user_id',$id)->pluck('role_id')->all();
        return view('admin.user.tianjia', compact('user','roles','own_roles'));
    }
     public function doauth(Request $request)
     {
        //        1 获取要授权的用户
         $user_id =  $request->input('user_id');

//        2 获取要给用户授与的角色
        $roles = $request->input('role_id');


        //dd($roles);
//        删除当前用户的所有角色
        \DB::table('blog_user_role')->where('user_id',$user_id)->delete();
//         3 执行授权操作
        foreach ($roles as $role) {
            \DB::table('blog_user_role')->insert(['user_id'=>$user_id,'role_id'=>$role]);
        }

        return redirect('admin/user');

//        4 授权成功或失败的处理
     }


    public function edit($id)
    {   

        $tmp = index_users_login::where('user_id',$id)->first(); 
        $user_id = $tmp ->user_id;
         $name = $tmp->login_name;
        return view('admin.user.edit', compact('name','user_id'));
    }




     public function ban(Request $request, $id)
    {   
        $ban = $request->ban;

        $re =\DB::table("data_users_info")->where('user_id',$id)->update(['ban'=>$ban]); 
          if($re > 0){
            $data = 1;
          }else {
            $data = 2;
          }
        return $data;  
    }

    public function update(Request $request,$id)
    {
        $pwd = $request->input('pwd');
        $res = index_users_login::where('user_id',$id)->update(['password'=>$pwd]);
        $re = data_users_register::where('id',$id)->update(['password'=>$pwd]);

       //  $tmp = new data_users_register();
       //save 更改需要改全部字段,否者会报错;
       //  $tmp -> password = $pwd;
       //  $re =  $tmp -> save();
       // dd($re);
        if($res && $re){
            return back()->with('mes','修改成功!');  
        } else {
            
           return back()->with('mes','修改失败!');
        }
    }


    
}