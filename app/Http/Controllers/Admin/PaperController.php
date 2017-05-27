<?php

namespace App\Http\Controllers\Admin;

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


}
