<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{


    /**
     * 登录模板渲染
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Login() {
        return view('Admin/Login/login');
    }


    /**
     * 验证用户登录
     */
    public function LoginCheck() {
        $name = Input::get('name') ;
        $password = Input::get('password') ;
        if(Auth::admin()->attempt(['name'=>$name,'password'=>$password])){
                // 跳转到后台首页
//            return redirect()->intended("admin/");
            $array = [
                'data' => '验证成功',
                'success' => true,
            ];
            // 存储用户session
            session(['name'=>$name]);
        }else {
            $array = [
                'data' => '用户或密码错误',
                'success' => false,
            ];
        }
        return response()->json($array);
    }


    /**
     * 验证码的生成
     * @param $tmp
     */
    public function captcha($tmp){
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::flash('milkcaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }


    /**
     * 验证码的验证
     */
    public function checkVerify() {
        $captcha = Session::get('milkcaptcha');
        $veryfy = Input::get("code");
        if($captcha == $veryfy) {
            $array = [
                'data' => '验证成功',
                'success' => true,
            ];
        }else{
            $array = [
                'data' => '验证码错误',
                'success' => false,
            ];
        }
        return response()->json($array);
    }

    /**
     * 用户登出
     */
    public function LogOut(Request $request) {
        Auth::logout();
        $request->session()->flush();
        // 登出后默认跳到登录路由
        return redirect('admin/login');
    }


}
