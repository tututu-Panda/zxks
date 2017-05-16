<?php

namespace App\Http\Controllers\Home;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

/**
 * 学生端登录控制器
 * Class LoginController
 * @package App\Http\Controllers\Home
 */

class LoginController extends Controller
{
    /**
     * @function: 登录模板渲染
     * @Author:梁轩豪
     * @DateTime:  2017-05-07 15:05:03
     * @return     [type]                   [description]
     */
    public function login()
    {
       return view('Home.Login.login');
    }

    /**
     * @Function:
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     */
    public function checkLogin() {
        //获取输入的账户和密码
        $account = Input::get('account');
        $password = Input::get('password');
        if(Auth::user()->attempt(['account'=>$account,'password'=>$password])){
            // 跳转到后台首页
//            return redirect()->intended("admin/");
            $array = [
                'data' => '验证成功',
                'success' => true,
            ];
            // 存储用户session
            session(['home_account' => $account]);
        }else {
            $array = [
                'data' => '用户或密码错误',
                'success' => false,
            ];
        }
        return response()->json($array);
    }

    public function logout(Request $request) {
        Auth::user()->logout();
        $request->session()->flush();
        // 登出后默认跳到登录路由
        return redirect('home/login');
       
    }

    public function testmenu() {
        return view('Home.layouts.layout');
    }

    
    
}
