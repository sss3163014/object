<?php

namespace App\Http\Middleware;

use App\Model\blog_user_role;
use App\Model\blog_permission_role;
use App\Model\blog_permission;
use Closure;

class hasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        1 获取当前请求的路由对应的控制器的方法名
        $route = \Route::current()->getActionName();
        // dd($route);
//        2 获取当前用户
        $user_id = $request->session()->all()['admin_user']['user_id'];
        //dd($user_id);
//        3 获取当前用户的权限
        //获取当前用户的角色
        $roles =  blog_user_role::where('user_id', $user_id )->pluck('role_id')->all();
        // dd($roles);
        //判断是否是超级管理员,是超级管理员直接进入页面，不判断权限。
        if(in_array(1,$roles)){
            return $next($request);
        }
        // dd($roles);

//         2.3 获取角色对应的权限
        foreach ($roles as $k=>$role){
            //每次遍历获取一个角色，然后获取这个角色对应的权限
            // dd($role);
            $pers =  blog_permission_role::where('role_id', $role )->pluck('permission_id')->all();
//           遍历当前角色对应的权限
            foreach ($pers as $m=>$per){
                $arr[] = blog_permission::where('id', $per )->pluck('permission_name')->all();
            }
        }
        // dd($arr);
            //把二维数组合并成一维数组
            function merge_array($arr){  
                return call_user_func_array('array_merge',$arr);  
            }  

       // 去掉arr数组中重复的权限
        $newarr = array_unique(merge_array($arr));
       // dd($newarr);

//    3 判断当前路由对应的控制器的方法是否在用户对应的权限中，如果在就放行，如果不在提示没有权限

        if(in_array($route,$newarr)){
            return $next($request);
        }else{
            return redirect('admin/nopermission');
        }
    }
}
