<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\blog_role;
use App\Model\blog_permission;
use App\Model\blog_permission_role;


class RoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //搜索加分页
        if($request->has('name')) {
            $input = trim($request->input('name'));
            $array = blog_role::where('role_name', 'like','%'.$input.'%')->paginate(2);
            return view('admin.role.roleList',compact('array','input'));
        }else{
            $input = "";
            $array = blog_role::paginate(2);
            return view('admin.role.roleList',compact('array','input'));
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示创建角色页面
        return view('admin.role.roleCreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 保存提交数据...

        $flight = new blog_role;

        $flight->role_name = $request->role_name;
        $flight->role_description = $request->role_description;

        $flight->save();
        
        return redirect('admin/roleList');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role_array = blog_role::where('role_id',$id)->get()->first();
        //显示修改角色页面
        return view('admin.role.roleChange',compact('role_array'));
        // return view('admin.roseChange', compact('id'));
    }


    public function fsave(Request $request)
    {
        blog_role::where('role_id',$request->role_id)
                  ->update(['role_description' => $request->role_description,'role_name' => $request->role_name]
                            );
   
        //显示角色页面
        return redirect('admin/roleList');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //角色授权页面
        //查询数据库指定字段
        $role_array = blog_role::where('role_id',$id)->get()->first();
        $permission_array = blog_permission::get();
        $permission_role_array = blog_permission_role::where('role_id',$id)->pluck('permission_id')->all();
        
        //把数组传到前台显示
        return view('admin.role.roleEdit', compact('role_array','permission_array','permission_role_array'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 1.获取要授权的角色
        $role_id =  $request->input('user_id');

        // 2.获取要给角色的权限
        $req = $request->input('permission_id');

        // dd($req);
        // 3.删除当前角色的所有权限
        $a = blog_permission_role::where('role_id',$role_id)->delete();
        var_dump($a);

        // 4.执行授权操作
        foreach ($req as $req) {
            $flight = new blog_permission_role;

            $flight->role_id = $id;
            $flight->permission_id = $req;

            $flight->save();
        }
        
        return redirect('admin/roleList');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $flight = blog_role::where('role_id',$id);

        $flight->delete();

        return redirect('admin/roleList'); 

    }
}
