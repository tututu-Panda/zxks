<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 成绩管理面板
 * Class ScoreController
 * @package App\Http\Controllers\Admin
 */
class ScoreController extends Controller
{

    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 成绩查询
     */
    public function index()
    {
        return view('Admin.Score.index');
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 成绩统计
     */
    public function total() {
        return view('Admin.Score.total');
    }



}
