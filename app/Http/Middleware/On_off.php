<?php

namespace App\Http\Middleware;

use App\Model\data_basic_config;
use Closure;

class On_off
{
    /**
     * 网站是否维护中间键
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $re = data_basic_config::where('site_name', 'wed_status')->first();
        // dd($re->site_content);
        if ($re->site_content == '关') {
            return redirect('weihui');
        }
        return $next($request);
    }
}
