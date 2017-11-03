<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\blog_user_role;
class Login
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
        if (!session()->has('admin_user')){
            return redirect('admin/login');
        }else{
      
            $us = $request->session()->all()['admin_user']['user_id'];
            // $array = blog_user_role::findOrFail($us);

            $array = blog_user_role::pluck('user_id')->all();
            // dd($array);
            if(in_array($us, $array)) {
                return $next($request);
            }else {
                return redirect('/admin/login')->with('errors','用户未登录');
            }
        }
        // if (!session()->has('admin_user')){
        //     return redirect('admin/login');
        // }   
        // return $next($request);
    }
}
