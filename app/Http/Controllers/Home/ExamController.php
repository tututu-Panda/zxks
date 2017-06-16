<?php

namespace App\Http\Controllers\Home;

use App\Models\Databases;
use App\Models\Score;
use App\Models\Home\Scores;
use App\Models\TestPaper;
use App\Models\Home\Student;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

/** 学生端考试控制器
 * Class ExamController
 * @package App\Http\Controllers\Home
 */
class ExamController extends Controller
{
    /**
     * 展现未考过的试卷，已经考过的不在显示
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examIndex()
    {
        $stu_account = session('home_account');  //获取登录的session账户
        $stu_id = Student::where('account',$stu_account)->select('id')->first()->toArray(); //获取学生账户对应的id
        $testedPaper = Scores::where('account',$stu_account)->select('testpaper_id')->get()->toArray();      //获取已经考过的试卷ID
        $notIds = array_column($testedPaper, 'testpaper_id');           //将二维数组转为一维数组
        $javapaperList = TestPaper::where('type',1)->whereNotIn('id',$notIds)->get()->toArray();
        $cpaperList = TestPaper::where('type',2)->whereNotIn('id',$notIds)->get()->toArray();
        return view('Home.Exam.examIndex',compact('javapaperList','cpaperList'));
    }

    /**
     * @Function: 从试卷表中读取进行出卷
     * PS:注意时间的范围是否合法
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function examTest($id) {
        date_default_timezone_set('PRC');           //设置时区为北京时间
        $detail = TestPaper::find($id)->toArray();
        $beginTime = $detail['beginDate'];          //获取考试开始时间
        $endTime = $detail['endDate'];              //获取考试结束时间
        $nowTime = date("Y-m-d H:i:s");             //获取当前的系统时间并格式化
        $stu_account = session('home_account');  //获取登录的session账户
        $stu_id = Student::where('account',$stu_account)->select('id')->first()->toArray(); //获取学生账户对应的id
        //判断时间
        //考试时间暂未到
        if(strtotime($nowTime) < strtotime($beginTime)){
            return "<script>alert('还未到考试时间');</script>";
        }
        else if(strtotime($nowTime) > strtotime($endTime)){       //时间已经截止
            return "<script>alert('考试时间已过了');</script>";
        }else {

            $idsArr_cho = explode(',',$detail['choice_ids']);       //将题号集合转化为数组，方便下面条件查找
            $idsArr_fill = explode(',',$detail['fill_ids']);
            $DataTemp = new Databases();            //实例化模型
            $choiceList = $DataTemp->getPaperQues($idsArr_cho);     //获取选择题
            $fillList = $DataTemp->getPaperQues($idsArr_fill);      //获取填空题
            $paperId = $id;
            $stuId = $stu_id['id'];
            $paperName = $detail['name'];
            return view('Home.Exam.examTest',compact('choiceList','fillList','endTime','paperId','stuId','paperName'));
        }

    }

    /**
     * @Function: 批改试卷处理
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     */
    public function checkPaper(Request $request) {
        //获取所有的表单数据
        $input = $request->all();
        //p($input);die;
        $detail = TestPaper::find($input['paperId'])->toArray();  //获取该试卷的信息
        $idsArr_cho = explode(',',$detail['choice_ids']);       //将题号集合转化为数组，方便下面条件查找
        $idsArr_fill = explode(',',$detail['fill_ids']);
        //查找出选择题答案，转化为一维数组
        $choiceAns = Databases::whereIn('id',$idsArr_cho)->select('select')->get()->toArray();
        $choiceAns_one = array_column($choiceAns,'select');

        //查找出填空题答案，转化为一维数组
        $fillAns = Databases::whereIn('id',$idsArr_fill)->select('answer')->get()->toArray();
        $fillAns_temp = array_column($fillAns,'answer');
        //将填空题答案读取出来，并按约定符号分隔开，形成二维数组
        $fillAns_one = array();
        foreach ($fillAns_temp as $fTemp) {
            $aTemp  = explode('/_',$fTemp);     //按符号分隔成一维数组
            array_push($fillAns_one,$aTemp);      //一维数组压入二维数组
        }
        $choice_count = 0;        //记录正确的选择题
        $fill_count = 0;        //记录正确的填空题
        //循环匹配检查选择题的答案
        for($i = 1;$i < $input['i'];$i++) {
            if($input['q'.$i] == $choiceAns_one[$i-1]) {
                DB::table('finaltests')->insert([
                    'testpaper_id' => $input['paperId'],
                    'student_id' => $input['stuId'],
                    'question_id' => $idsArr_cho[$i-1],
                    'type_id' => 1,
                    'is_true' => 1        //1正确，0错误
                ]);
                $choice_count++;          //技术加一
            }else {
                DB::table('finaltests')->insert([
                    'testpaper_id' => $input['paperId'],
                    'student_id' => $input['stuId'],
                    'question_id' => $idsArr_cho[$i-1],
                    'type_id' => 1,
                    'is_true' => 0
                ]);
            }
        }
        //循环匹配检查填空题的答案，判断输入的填空题是否存在于答案数组中
        for($j = 1;$j < $input['j'];$j++) {
            if(in_array($input['f'.$j], $fillAns_one[$j-1])) {
                DB::table('finaltests')->insert([
                    'testpaper_id' => $input['paperId'],
                    'student_id' => $input['stuId'],
                    'question_id' => $idsArr_fill[$j-1],
                    'type_id' => 2,
                    'is_true' => 1
                ]);
                $fill_count++;
            }else {
                DB::table('finaltests')->insert([
                    'testpaper_id' => $input['paperId'],
                    'student_id' => $input['stuId'],
                    'question_id' => $idsArr_fill[$j-1],
                    'type_id' => 2,
                    'is_true' => 0
                ]);
            }
        }
        $stu = Student::where('id',$input['stuId'])->select('account')->first()->toArray(); //获取学生账户对应的id
        $jsonData = $this->addScore($stu['account'],$input['paperId'],$choice_count,$fill_count,$detail['beginDate']);
        return response()->json($jsonData);
    }

    public function addScore($account,$paperId,$choice_count,$fill_count,$start_time) {
        //选择题每道5分
        $choice_grade = $choice_count * 5;
        //填空题每道5分
        $fill_grade = $fill_count * 5;
        //总分
        $total = $choice_grade + $fill_grade;
        $data = [
            'account' => $account,
            'testpaper_id' => $paperId,
            'score' => $total,
            'start_time' => $start_time,
            'end_time' => date("y-m-d h:i:s"),
        ];
        $score = Scores::create($data);
        if($score) {
            $jsonData = [
                'success' => true,
                'msg' => '成功!',
            ];
        }else {
            $jsonData = [
                'success' => false,
                'msg' => '失败!',
            ];
        }
        return $jsonData;
    }


}
