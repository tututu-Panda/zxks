<?php

namespace App\Http\Controllers\Admin;

use App\Models\Score;
use App\Models\Student;
use App\Models\TestPaper;
use App\Models\TestType;
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
    public function index(Request $request)
    {
        $subject = $request->get('subject',"");             //获得请求学科
        $testpaper = $request->get('testpaper','');         //获得请求试卷
        $keywords = $request->get('keywords','');             //获得请求关键字

        if($subject == "" && $testpaper ==  "" && $keywords == "") {
            // 一. 默认获得一个java试卷名称及学生信息

            // 1. 获得一张试卷
            $paper = TestPaper::all()->take(1)->toArray();
            $allpaper = TestPaper::all()->toArray();
            // 2. 得到所有学生得分
            $students = "";
            foreach ($paper as $key => $value) {
                $students[$key] = TestPaper::find($value['id'])
                    ->scores()
                    ->orderBy('account')
                    ->get()->toArray();

            }
            foreach ($students as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $paper_name = TestPaper::select('name')->where('id', $value1['testpaper_id'])->get()->toArray(); //获得试卷名称
                    $account = Student::select('name')->where('id', $value1['account'])->get()->toArray(); //获得学生姓名
                    $type = TestPaper::select('type')->where('name', $paper_name[0]['name'])->get()->toArray();
                    $students[$key][$key1]['testpaper_name'] = $paper_name[0]['name'];
                    $students[$key][$key1]['name'] = $account[0]['name'];
                    $students[$key][$key1]['id'] = $value1['account'];                                  //获得id信息
                    $students[$key][$key1]['type'] = $type[0]['type'];                                  //获得id信息
                }
            }
        }

//        $requestPage = Request::get('requestPage','');     //获得请求页码
//        $keyword = Request::get('keyword','');             //获得请求关键字

//        if($keyword!="") {
//            $map['account'] = array('like','%'.$keyword.'%');     // 获得关键字
//        }

//        $pagesize=2;                            // 每页显示内容
//        $total=count($students);                // 总的个数
//        $pages=ceil($total/$pagesize);    // 获得总的页数

        // 二. 根据传入条件进行查询
        // 1. 传入学科，试卷，学号或名称（根据试卷获得学生）

        // 2. 进行分页处理
        else if($subject != "" && $testpaper !=  "" && $keywords == ""){
            $paper = TestPaper::where(array('type'=>$subject,'id'=>$testpaper))->get()->toArray();
            $allpaper = TestPaper::where('type',$subject)->get()->toArray();
            $students = "";
            foreach ($paper as $key => $value) {
                $students[$key] = TestPaper::find($value['id'])
                    ->scores()
                    ->orderBy('account')
                    ->get()->toArray();

            }
            foreach ($students as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $paper_name = TestPaper::select('name')->where('id', $value1['testpaper_id'])->get()->toArray(); //获得试卷名称
                    $account = Student::select('name')->where('id', $value1['account'])->get()->toArray(); //获得学生姓名
                    $type = TestPaper::select('type')->where('name', $paper_name[0]['name'])->get()->toArray();
                    $students[$key][$key1]['testpaper_name'] = $paper_name[0]['name'];
                    $students[$key][$key1]['name'] = $account[0]['name'];
                    $students[$key][$key1]['id'] = $value1['account'];                                  //获得id信息
                    $students[$key][$key1]['type'] = $type[0]['type'];                                  //获得id信息
                }
            }

        }

        else{
            $student = Student::where('name','like',"%".$keywords."%")->orwhere('account','like',"%".$keywords."%")->get()->toArray();
            $score = Score::where(array('account'=>$student[0]['id'],'testpaper_id'=>$testpaper))->orderBy('testpaper_id')->get()->toArray();
            $allpaper = TestPaper::all()->toArray();
            $students = "";
            foreach ($score as $key=>$value){
                $paper_name = TestPaper::select('name','type')->where('id', $value['testpaper_id'])->get()->toArray(); //获得试卷名称
                $students[0][$key]['account'] = $student[0]['account'];
                $students[0][$key]['testpaper_id'] = $value['testpaper_id'];
                $students[0][$key]['score'] = $value['score'];
                $students[0][$key]['testpaper_name'] = $paper_name[0]['name'];
                $students[0][$key]['name'] = $student[0]['name'];
                $students[0][$key]['id'] = $student[0]['id'];
                $students[0][$key]['type'] = $paper_name[0]['type'];
            }
        }
//        var_dump($students);
//        exit();
        return view('Admin.Score.index',compact('students','paper','allpaper','subject','testpaper','keywords'));

    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 动态获得试卷
     */
    public function getPaper(Request $request) {
        $subject = $request->get('subject','');             //获得请求学科
        if($subject == ""){
            $return =  '请选择学科';
                ;
        }else{
            $paper = TestPaper::where('type',$subject)->get()->toArray();

            foreach ($paper as $key=>$value){
                $return[$key]['name'] = $value['name'];
                $return[$key]['id'] = $value['id'];
            }
        }
        return response()->json($return);
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 成绩统计
     */
    public function total(Request $request) {
        $subject = $request->get('subject',"");             //获得请求学科
        $testpaper = $request->get('testpaper','');         //获得请求试卷
        if($testpaper !=""){
            $allpaper = TestPaper::where('type',$subject)->get()->toArray();
        }else{
            $allpaper = TestPaper::all()->toArray();
        }

        // 得到所有及格率信息
        $score = new Score();
        $circle = $score->getAllScoreRate($testpaper);

        // 得到所有分数信息
        $pillar = $score->getAllScore($testpaper);

//        var_dump($pillar);
//        exit();

        return view('Admin.Score.total',compact('subject','testpaper','allpaper','circle','pillar'));
    }



}
