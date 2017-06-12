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
     * @Author:
     * @DateTime:  2017-05-07 15:05:03
     * @return     [type]                   [description]
     */
    public function login()
    {
       return view('Home.Login.login');  //显示学生登录窗口
    }

    /**
     * @Function: 检查输入的登录信息
     * @Author:
     * @DateTime: ${DATE} ${TIME}
     */
    public function checkLogin() {
        //获取输入的账户和密码
        $account = Input::get('account');
        $password = Input::get('password');
        //调用Auth验证账户密码是否正确
        if(Auth::user()->attempt(['account'=>$account,'password'=>$password])){
            // 跳转到后台首页
//            return redirect()->intended("admin/");
            //返回信息json数组，如果登录信息正确，则通过js 跳转到学生端首页
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
        return response()->json($array);        //返回json字符串
    }

    /**
     * @Function: 退出登录方法
     * @Author:
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request) {
        Auth::user()->logout();
        $request->session()->flush();           //删除会话
        // 登出后默认跳到登录路由
        return redirect('home/login');
       
    }

//    public function testmenu() {
//        return view('Home.layouts.layout');
//    }

    
    
}
