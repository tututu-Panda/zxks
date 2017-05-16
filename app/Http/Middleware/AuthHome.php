<?php

namespace App\Http\Middleware;


use Closure;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Auth\Guard;

class AuthHome
{
//    protected $auth;
//    public function __construct(Guard $auth)
//    {
//        $this->auth = $auth;
//    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //通过对是否有session来判断是否经过登录
        $temp = session('home_account');
        if (!isset($temp)|| empty($temp)) {
            return redirect()->guest('home/login'); //验证不通过，跳转到登录页面
        }else {
            return $next($request);         //验证通过，进行下一步
        }

    }
}
