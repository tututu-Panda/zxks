<?php

namespace App\Http\Controllers\Admin;

use App\Models\Databases;
use App\Models\Student;
use App\Models\Sysuser;
use App\Models\TestPaper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $account = session('account');
        $img = Sysuser::where('account',$account)->select('photo')->get()->toArray();
        $photo = $img[0]['photo'];
        return view('Admin/Index/index',compact('account','photo'));
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 控制面板渲染
     */
    public function main(){
        // 学生数量
        $stuNum = Student::all()->count();
        // 题库数量
        $baseNum = Databases::all()->count();
        // 启用试卷
        $useNum = TestPaper::where('is_use',1)->count();
        // 停用试卷
        $stopNum = TestPaper::where('is_use',0)->count();

        // 在线统计

        // 试卷状态
        $testpaper = new TestPaper();
        $usePaper = $testpaper->getPaperList('all','1','1','5');
        $usePaper = $usePaper['list'];
        $stopPaper = $testpaper->getPaperList('all','0','1','5');
        $stopPaper = $stopPaper['list'];


        // 排行榜

        return view("Admin.Index.main",compact('stuNum','baseNum','useNum','stopNum'));
    }


}
