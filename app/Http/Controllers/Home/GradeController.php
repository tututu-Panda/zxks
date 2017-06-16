<?php

namespace App\Http\Controllers\Home;

use App\Models\Databases;
use App\Models\Home\Scores;
use App\Models\TestPaper;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Student;
/**
 * 学生端考试成绩查看控制器
 * Class GradeController
 * @package App\Http\Controllers\Home
 */
class GradeController extends Controller
{

    public function gradeIndex(Request $request)
    {
        $requestPage = $request->get('requestPage',1); //获取请求的页码数，默认为1
        $stu_account = session('home_account');  //获取登录的session账户
        $stu_id = Student::where('account',$stu_account)->select('id')->first()->toArray(); //获取学生账户对应的id
        $paperList = DB::table('scores as t1')->where('t1.account',$stu_account)->leftJoin('testpapers as t2', 't1.testpaper_id','=','t2.id')->
        select('t1.id as scoreId','t1.account as scoreAcco','t1.testpaper_id as paperId','t1.score as score','t1.start_time as sTime','t1.end_time as eTime','t2.name as paperName')->
        orderBy('t1.id','desc')->get();
        $total = DB::table('scores')->where('account',$stu_account)->count(); //统计该学生的所有成绩信息条数
        $pages = 0;     //初始化页数变量
        $rows = 3;      //设置每页显示的条数
        if($total%$rows == 0) {
            $pages = $total/$rows;
        }else {
            $pages = intval($total/$rows + 1);
        }
        //将查询后的所有符合条件的数据放入集合，然后根据页数来对数据进行划分获取，数组索引
        //collect集合和slice切片选择页数内容
        $listData = collect($paperList)->slice(($requestPage -1)*$rows, $rows);
        return view('Home.Grade.gradeIndex',compact('listData','pages','requestPage'));
    }
    public function gradeDetail($paperId) {
        $question_ids = TestPaper::find($paperId)->toArray();
        $paperName = $question_ids['name'];
        $questionId_string = $question_ids['choice_ids'].','.$question_ids['fill_ids'];
        $idsArr = explode(',',$questionId_string);       //将题号集合转化为数组，方便下面条件查找
        $DataTemp = new Databases();
        $quesType = $DataTemp->getStuQuesType($idsArr);
        $quesDiff = $DataTemp->getStuQuesDiff($idsArr);
        $total = count($idsArr);       //统计转化后的题目数组，统计总的题数
        $echarData1 = $total.','.$quesType.','.$quesDiff;         //将字符串拼接成合适的顺序

        $stu_account = session('home_account');  //获取登录的session账户
        $stu_id = Student::where('account',$stu_account)->select('id')->first()->toArray(); //获取学生账户对应的id
        //统计该套试卷该名学生的错题个数
        $defaultC = DB::table('finaltests')->where(['testpaper_id'=>$paperId,'student_id'=>$stu_id,'is_true'=>0])->count();
        $scoreArr = Scores::where(['testpaper_id'=>$paperId,'account'=>$stu_account])->select('score')->get()->toArray();
        $score = $scoreArr[0]['score'];     //获取该卷的成绩分数
        //错误的选择题的数目
        $choiceFault = DB::table('finaltests')->where(['type_id'=>1,'is_true'=>1])->count();
        //错误的填空题数目
        $fillFault = DB::table('finaltests')->where(['type_id'=>2,'is_true'=>1])->count();
        return view('Home.Grade.gradeDetail',compact('echarData1','paperName','defaultC','score','choiceFault','fillFault'));
    }


}
