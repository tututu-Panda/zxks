<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EditPaperRequest;
use App\Models\Databases;
use App\Models\Student;
use App\Models\TestPaper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


/**
 * 试卷管理面板
 * Class PaperController
 * @package App\Http\Controllers\Admin
 */
class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     * 试卷列表展示
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // 接受信息
        $subject = $request->get('subject',"all");
        $is_use = $request->get('is_use',"all");
        $map = array();
        if($subject != "all"){
            $map["type"] = $subject;
        }

        if($is_use != "all") {
            $map['is_use'] = $is_use;
        }

//            $allpaper = TestPaper::all()->toArray();
        $allpaper = TestPaper::where($map)->orderBy('is_use','desc')->get()->toArray();

//        var_dump($allpaper);
//        exit();


        return view('Admin.Paper.index',compact('subject','is_use','allpaper'));
    }


    /**
     * Created by
     * Author : pjy
     * Date : {$DATE}
     * Time : {$TIME}
     * 启用试卷
     */
    public function usePaper(Request $request) {
        $paper = new TestPaper();
        $id = $request->get('id');
        $action = $request->get('action');
        if($action == 'use'){
            $return = $paper->useit($id);
        }
        if($action == 'stop'){
            $return = $paper->stopit($id);
        }

//        var_dump($return);
//        exit();

        return response()->json($return);
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 出卷管理
     */
    public function setPaper() {
        return view('Admin.Paper.setpaper');
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 根据题库id,获得所有题目
     */
    public function dbIndex(Request $request){
        // 获取类型id
        $type = $request->get('type');
        // 获得题库类型
        $testpaper_type= $request->get('testpaper_type');
        // 获得关键字
        $keywords = $request->get('keywords',"");

        if($type == 1){
            $type_name = "选择题";
        }else if($type == 2){
            $type_name = "填空题";
        }
        // 根据题目类型及题库类型得到题目列表
        $question_list = Databases::where(['question_type'=>$type,'databasetype_id'=>$testpaper_type])
            ->where('id','like',"%".$keywords."%")
            ->where('question','like',"%".$keywords."%")
            ->select('id','question')->get()->toArray();
//        var_dump($question_list);
        return view("Admin.Paper.dbindex",compact('type_name','question_list'));
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 试卷出卷
     */
    public function addPaper(EditPaperRequest $request){
        // 经过验证规则后添加试卷
        $status = TestPaper::create($request->all());
//        var_dump($status);
//        exit();
        if($status){
            $return = array(
                'data' => '添加成功！',
                'status' => 'success'
            );
        }else {
            $return = array(
                'data' => '添加失败！',
                'status' => false
            );
        }
        return response()->json($return);

    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 编辑试卷
     */
    public function editPaper(Request $request){
        $id = $request->get('testpaper_id');


        return view('Admin/Paper/edit',compact('id'));
    }


}
