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
        $result = data_basic_config::find(1);
        $off = $result->no_off;
        if ($off == 0) {
            return redirect('weihui');
        }
        return $next($request);
    }
}
