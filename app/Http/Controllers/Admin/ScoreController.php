<?php

namespace App\Http\Controllers\Admin;

use App\Models\Databases;
use App\Models\FinalTest;
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
        $subject = $request->get('subject',"1");            //获得请求学科
        $testpaper = $request->get('testpaper','1');        //获得请求试卷
        $keywords = $request->get('keywords','');           //获得请求关键字
        $requestPage = $request->get('requestPage', 1);	    //获取请求的页码数
        $rows = 10;                                                     //每页展示数据

        $score = new Score();
        $list = $score->getAllList($subject,$testpaper,$keywords,$requestPage,$rows);
        $students = $list['list'];                                      //　学生列表
        $allpaper = $list['allpaper'];                                  // 试卷列表
        $pages = $list['pages'];                                        //  分页

        return view('Admin.Score.index',compact('students','allpaper','subject','testpaper','keywords','pages','requestPage'));


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
            // 获得全部试卷
            $paper = TestPaper::where('type',$subject)->orderBy('id','asc')->get()->toArray();

            // 遍历所有试卷
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
        $name="";
        if($testpaper !=""){
            $allpaper = TestPaper::where('type',$subject)->get()->toArray();
            $name = TestPaper::where('id',$testpaper)->select(['name'])->get()->toArray();
            $name = $name[0]['name'];
        }else{
            $allpaper = TestPaper::all()->toArray();
        }

        // 得到所有及格率信息
        $score = new Score();

        $circle = $score->getAllScoreRate($testpaper);

        // 得到所有分数信息
        $pillar = $score->getAllScore($testpaper);

//        var_dump($name);
//        exit();
        if($name==""){
            $name='所有试卷';
        }

        return view('Admin.Score.total',compact('subject','testpaper','allpaper','circle','pillar','name'));
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 学生详细信息
     */
    public function details(Request $request){
        $testpaper = $request->get('testpape_id');
        $account = $request->get('account_id');

        // 获得考卷名称
        $testpaper_name = TestPaper::where('id',$testpaper)->select('name')->get()->toArray();
        $testpaper_name = $testpaper_name[0]['name'];
        // 获得姓名
        $name = Student::where('id',$account)->select('name')->get()->toArray();
        $name = $name[0]['name'];
        // 获得总分
        $finalScore = Score::where(['account'=>$account,'testpaper_id'=>$testpaper])->select('score')->get()->toArray();
        $finalScore = $finalScore[0]['score'];

        // 获得选择题正确数量
        $choiceNum = FinalTest::where(['student_id'=>$account,'testpaper_id'=>$testpaper,'type_id'=>1,'is_true'=>1])->count();
        // 获得填空题正确数量
        $fillNum = FinalTest::where(['student_id'=>$account,'testpaper_id'=>$testpaper,'type_id'=>2,'is_true'=>1])->count();

        // 获得困难题正确数量
        $difficultNum = 0;
        // 获得简易题正确数量
        $easyNum = 0;

        //获得所有题目
        $question_ids = FinalTest::where(['student_id'=>$account,'testpaper_id'=>$testpaper])->select('question_id')->get()->toArray();
        $databases = new Databases();
        foreach ($question_ids as $vkey => $value){
            $difficultType = $databases->getDifficultById($value['question_id']);
            // 为困难题目
            if($difficultType[0]['difficult'] == 3){
                $difficultNum++;
            }
            // 简易题目
            else if($difficultType[0]['difficult'] == 1){
                $easyNum++;
            }
        }

//        var_dump($difficultNum);
//        exit();
        return view('Admin.Score.details',compact('testpaper_name','name','finalScore','choiceNum','fillNum','difficultNum','easyNum'));
    }


}
