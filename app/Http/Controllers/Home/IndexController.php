<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        return view('Home.Index.personInfo');
    }
    public function modifyPsw() {
        return view('Home.Index.modifyPsw');
    }

}
