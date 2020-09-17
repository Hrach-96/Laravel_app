<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class IsLogin
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
        if (Session::get('userData')) {
            return $next($request);
        }
        Session::put('referer',url()->current());
        if($url = explode(url('/').'/', url()->current())){
            if(isset($url[1])){
                if(explode('/', $url[1])[0] == 'admin'){
                    return redirect(route('login.admin.get'));
                }else if (explode('/', $url[1])[0] == 'super_admin'){
                    return redirect(route('login.super_admin.get'));
                }
            }
        }

        return redirect(route('login.view'));

    }
}
