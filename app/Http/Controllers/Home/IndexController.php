<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Home\Student;
use DB;
class IndexController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('home');
//    }
    /**
     * @Function: 登录后前台首页模板视图
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Home.Index.index');
    }
    public function personInfo() {
        $stu_account = session('home_account');
        $info = Student::where('account',$stu_account)->first()->toArray();
        //$info2 = Student::where('account',$stu_account)->get()->toArray();
        //$info = DB::table('students')->where('account',$stu_account)->get();
        //p($info);die;
        //p($info['photo']);die;
        return view('Home.Index.personInfo',['info' => $info]);
    }
    public function modifyPsw() {
        return view('Home.Index.modifyPsw');
    }

}
