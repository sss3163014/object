<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\blog_permission;

class PermissionController extends Controller
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

            $array = blog_permission::where('permission_name', 'like','%'.$input.'%')->paginate(10);
            return view('admin.permission.permissionList',compact('array','input'));
        }else{
            $input = "";
            $array = blog_permission::paginate(10);
            return view('admin.permission.permissionList',compact('array','input'));
        }


        // //查询数据库所有字段
        // $array = blog_permission::paginate(2);
        // //把转换后的数组传到前台显示
        // return view('admin.permission.permissionList', compact('array','where'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //显示创建权限页面
        return view('admin.permission.permissionCreate');
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

        $flight = new blog_permission;

        $flight->permission_name = $request->permission_name;
        $flight->permission_description = $request->permission_description;

        $flight->save();
        
        return redirect('admin/permissionList');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission_array = blog_permission::where('id',$id)->get()->first();
        //显示修改权限页面
        return view('admin.permission.permissionChange',compact('permission_array'));
        // return view('admin.roseChange', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function fsave(Request $request)
    {
        blog_permission::where('id',$request->permission_id)
                  ->update(['permission_description' => $request->permission_description,'permission_name' => $request->permission_name]
                            );
   
        //显示角色页面
        return redirect('admin/permissionList');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = blog_permission::where('id',$id);

        $flight->delete();

        return redirect('admin/permissionList');
    }
}
