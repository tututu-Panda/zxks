<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    // 得分与试卷的关系为：被属于试卷
    public function testpaper() {
        return $this->belongsTo('App\Models\TestPaper','id');
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 返回成绩查询信息
     */
    public function getAllList($subject,$testpaper,$keywords,$requestPage,$rows){
        // 定义查询数组
        $all=[];
        $map=[];
        $total=0;
        // 查询关键字的条件
        if($keywords != ""){
            $student = Student::where('name','like',"%".$keywords."%")->orwhere('account','like',"%".$keywords."%")->get()->toArray();
            $allpaper = TestPaper::where('type',$subject)->get()->toArray();
            $students = "";
//            var_dump($student);
//            exit();
            if(empty($student)){
            }else{
                // 根据type获得所有试卷
                $skip = ($requestPage - 1) * $rows;
                // 获得总数
                $total =Score::where(array('account'=>$student[0]['id'],'testpaper_id'=>$testpaper))->count();
                // 根据偏移量得到数据
                $score = Score::where(array('account'=>$student[0]['id'],'testpaper_id'=>$testpaper))
                    ->orderBy('testpaper_id')->skip($skip)->take($rows)->orderBy('id')->get()->toArray();

                foreach ($score as $key=>$value){
                    $paper_name = TestPaper::select('name','type')->where('id', $value['testpaper_id'])->get()->toArray(); //获得试卷名称
                    $students[$key]['account'] = $student[0]['account'];
                    $students[$key]['testpaper_id'] = $value['testpaper_id'];
                    $students[$key]['score'] = $value['score'];
                    $students[$key]['testpaper_name'] = $paper_name[0]['name'];
                    $students[$key]['name'] = $student[0]['name'];
                    $students[$key]['id'] = $student[0]['id'];
                    $students[$key]['type'] = $paper_name[0]['type'];
                }
            }
        }else {

            // 查询学科的条件
            if ($subject != "") {
                $all['type'] = $subject;
            }
            // 查询试卷的条件
            if ($testpaper != "") {
                $map['testpaper_id'] = $testpaper;
            }

            // 根据type获得所有试卷
            $allpaper = TestPaper::where($all)->orderBy('id','desc')->get()->toArray();
//
            $skip = ($requestPage - 1) * $rows;
            // 获得总数
            $total = $this->where($map)->count();
            // 根据偏移量得到数据
            $students = $this->where($map)->skip($skip)->take($rows)->orderBy('id')->get()->toArray();
            // 格式化学生数据
            foreach ($students as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $paper_name = TestPaper::select('name')->where('id', $value['testpaper_id'])->get()->toArray(); //获得试卷名称
                    //                    var_dump($paper_name);
                    //                    exit();
                    $account = Student::select('name')->where('id', $value['account'])->get()->toArray(); //获得学生姓名
                    $type = TestPaper::select('type')->where('name', $paper_name[0]['name'])->get()->toArray();
                    $students[$key]['testpaper_name'] = $paper_name[0]['name'];
                    $students[$key]['name'] = $account[0]['name'];
                    $students[$key]['id'] = $value['account'];                                  //获得id信息
                    $students[$key]['type'] = $type[0]['type'];                                  //获得id信息
                }
            }

        }
        $data = array(
            'pages' => ceil($total / $rows),
            'list' => $students,
            'allpaper' => $allpaper
        );
        return $data;

    }



    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 得到所有成绩信息
     */
    public function getAllScoreRate($paper=""){
        // 所有试卷的信息
        if($paper == ""){
            $all = $this::all()->count();                               // 所有人数
            $unqualify = $this::where('score','<','60')->count();       // 不及格人数
            $qualify = $this::where('score','>','60')->count();         // 及格人数
            $full = $this::where('score','=','100')->count();           // 满分人数

            $return = array(
                'unqulify' => $unqualify,
                'qulify' => $qualify,
                'full' => $full
            );
        }else{
            $all = $this::where('testpaper_id',$paper)->count();        // 所有人数
            $unqualify = $this::where('testpaper_id',$paper)->where('score','<','60')->count();       // 不及格人数
            $qualify = $this::where('testpaper_id',$paper)->where('score','>','60')->count();         // 及格人数
            $full = $this::where('testpaper_id',$paper)->where('score','=','100')->count();           // 满分人数

            $return = array(
                'unqulify' => $unqualify,
                'qulify' => $qualify,
                'full' => $full
            );
        }
        return $return;
    }


    public function getAllscore($paper = ""){
        $data="";
        if($paper==""){
            for ($i = 0; $i <= 100; $i=$i+10){
                $j = $i + 10;
                if($i != 100){
                    $data[$i] = $this::where('score','>=',$i)->where('score','<',$j)->count();
                }else{
                    $data[$i] = $this::where('score','=',$i)->count();
                }
            }
        }else{
            for ($i = 0; $i <= 100; $i=$i+10){
                $j = $i + 10;
                if($i != 100){
                    $data[$i] = $this::where('testpaper_id',$paper)->where('score','>=',$i)->where('score','<',$j)->count();
                }else{
                    $data[$i] = $this::where('testpaper_id',$paper)->where('score','=',$i)->count();
                }
            }
        }


        return $data;
    }

    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 得到平均分最高的５位学生
     */
    public function getHighAveStu(){

    }
}
