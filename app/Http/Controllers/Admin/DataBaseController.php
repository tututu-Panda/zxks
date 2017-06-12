<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Contracts\Redis\Database;
use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Models\Databases;
use App\Models\DatabaseType;

/**
 * 题库管理面板
 * Class DataBaseController
 * @package App\Http\Controllers\Admin
 */
date_default_timezone_set('PRC');           //设置时区为北京时间
class DataBaseController extends Controller
{
    /**
     * @Function: 题库展示首页内容
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $test_id = $request->get('type_id','');  //获取所属学科的ID
        $keyword = $request->get('keyword','');//获取关键词
        //获取所有的题库种类
        //1.学科类型和关键词均不为空的时候
        if($test_id != '' && $keyword != '') {
            $base_list = DB::table('databases_type as t1')->where('t1.test_id',$test_id)->where('t1.name','like','%'.$keyword.'%')->leftJoin('testtypes as t2','t1.test_id','=','t2.id')->
            select('t1.id as dabase_id','t1.name as dabase_name','t1.create_time as dabase_time','t1.comment as dabase_comment','t2.name as type_name')->get();
        }else if($test_id != '') {
            //2.学科不为空的时候
            $base_list = DB::table('databases_type as t1')->where('t1.test_id',$test_id)->leftJoin('testtypes as t2','t1.test_id','=','t2.id')->
            select('t1.id as dabase_id','t1.name as dabase_name','t1.create_time as dabase_time','t1.comment as dabase_comment','t2.name as type_name')->get();

        }else if($keyword != ''){
            //3.关键词不为空的时候
            $base_list = DB::table('databases_type as t1')->where('t1.name','like','%'.$keyword.'%')->leftJoin('testtypes as t2','t1.test_id','=','t2.id')->
            select('t1.id as dabase_id','t1.name as dabase_name','t1.create_time as dabase_time','t1.comment as dabase_comment','t2.name as type_name')->get();
        }else {
            //4.均为空，默认状态
            $base_list = DB::table('databases_type as t1')->leftJoin('testtypes as t2','t1.test_id','=','t2.id')->
            select('t1.id as dabase_id','t1.name as dabase_name','t1.create_time as dabase_time','t1.comment as dabase_comment','t2.name as type_name')->get();
        }
//        $base_list = DB::table('databases_type as t1')->where('t1.test_id',$test_id)->where('t1.name','like','%'.$keyword.'%')->leftJoin('testtypes as t2','t1.test_id','=','t2.id')->
//        select('t1.id as dabase_id','t1.name as dabase_name','t1.create_time as dabase_time','t1.comment as dabase_comment','t2.name as type_name')->get();
        $test_type = DB::table('testtypes')->get();
        //p($base_list);die;
        return view('Admin.Database.index',
        [   'baseList' => $base_list,
            'testType' => $test_type,  //所有的学科类型
            'test_id' => $test_id,      //当前选择学科的类型
            'keyword' => $keyword       //输入的关键词
        ]);
    }

    /**
     * @Function: 添加题库提交处理
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addTypeHandle(Request $request) {
        $input = $request->all();
        //1.验证题库名是否为空（js已经判断）;2.验证题库名是否已经存在
        $this->validate($request, [
            'name' => 'required|unique:databases_type,name',
        ],[
            'name.required' => '题库名必须',
            'name.unique' => '题库名已经存在',
        ]);
        //插入数据库
        $result = DB::table('databases_type')->insert(['name' => $input['name'],'test_id' => $input['test_id'],'comment' => $input['comment'],'create_time' => time(),
        ]);
        //p($result);die;
        if($result === false) {
            $data = array(
                'success' => false,
                'msg' => '添加失败！'
            );
        }else {
            $data = array(
                'success' => true,
                'msg' => '添加成功！'
            );

        }
        //返回客户端json数据
        return response()->json($data);
    }
    /**
     * @Function: 点击编辑题库基本信息查找信息
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id 题库的数据库ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editType($id) {
        //查询第一条满足条件的数据，返回的默认为对象形式
        $info = DB::table('databases_type')->where('id',$id)->first();
        $test_type = DB::table('testtypes')->get();
        return view('Admin.Database.editType',['info' => $info,'testType' => $test_type]);
    }

    /**
     * @Function: 处理题库类型编辑后的提交
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editTypeHandle(Request $request) {
        $id = Input::get('id');
        $input = $request->all();
        //同样的验证
        $this->validate($request, [
            'name' => 'required|unique:databases_type,name,'.$id,
        ],[
            'name.required' => '题库名必须',
            'name.unique' => '题库名已经存在',
        ]);
        $result = DB::table('databases_type')->where('id',$id)->update(['name' => $input['name'],'test_id' => $input['test_id'],'update_time'=>time(),'comment' => $input['comment']]);
        if($result === false) {
            $data = array(
                'success' => false,
                'msg' => '更新失败！'
            );
        }else {
            $data = array(
                'success' => true,
                'msg' => '更新成功！'
            );

        }
        return response()->json($data);
    }

    /**
     * @Function: 删除题库类型，在这里先暂时不考虑软删除，直接从数据库中进行删除
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteType(Request $request) {
        $id = Input::get('id'); //获取要删除的题库类型id
        $result = DB::table('databases_type')->where('id',$id)->delete();
        if($result === false) {
            $data = array(
                'success' => false,
                'msg' => '删除失败！'
            );
        }else {
            $data = array(
                'success' => true,
                'msg' => '删除成功！'
            );

        }
        return response()->json($data);
    }
    /************************** 展示数据库的详细信息 ***************************/
    /**
     * @Function: 获取指定数据库的详细信息
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id 所选择的题库ID
     * @param Request $request
     */
    public function baseDetail($id,Request $request) {
        //分别获取传来的难度，题型和关键字
        $level = $request->get('level_id','');      //难度
        $typeLevel = $request->get('type_id','');      //题型
        $keyword = $request->get('keyword','');
        $requestPage = $request->get('requestPage',1); //获取请求的页码数，默认为1
        $type = DatabaseType::find($id)->toArray();     //获取题库的名称
        //实例化temp对象
        $DataTemp = new Databases();
        $que = $DataTemp->getList($id,$level,$typeLevel,$keyword,$requestPage); //获取题库字段值为id的题库的题目
        $difficult = $DataTemp->getDiffcult($id);       //调用方法获取各难度题目个数
        $qtype = $DataTemp->getType($id);               //获取各题型数目
        return view('Admin.Database.detail',[
            'difficult' => $difficult,
            'qtype' => $qtype,         //显示图表项
            'level' => $level,      //给选择难度条件赋值
            'typeLevel' => $typeLevel,  //题型
            'keyword' => $keyword,      //关键词
            'pages' => $que['pages'],   //总的页数
            'requestPage' => $requestPage,  //当前的页数
        ])->with('que',$que['listData'])->with('type',$type);
    }

    /**
     * @Function: 添加题目模板视图渲染
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id 题库
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addQuestion($id) {

        return view('Admin.Database.addQuestion',[
            'testdb_id' => $id,
        ]);
    }

    /**
     * @Function: 添加题目后的提交处理
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addQuesHandle(Request $request) {
        $input = $request->all();
        //公共字段
        $data = [
            'question' => $input['content'],
            'databasetype_id' => $input['testdb_id'],
            'question_type' => $input['type'],
            'difficult' => $input['level'],
            'create_time' => time(),
            'comment' => $input['comment'],
        ];
        //如果是选择题
        if(Input::has('select')) {
            $data['select'] = $input['select'];
            $data['option_a'] = $input['option_a'];
            $data['option_b'] = $input['option_b'];
            $data['option_c'] = $input['option_c'];
            $data['option_d'] = $input['option_d'];
        }else {
            //如果是填空题
            $data['answer']  = $input['answer'];
        }
        $result = Databases::create($data);
        if($result == false) {
            $jsonData = [
                'success' => false,
                'msg' => '添加失败！'
            ];
        }else {
            $jsonData = [
                'success' => true,
                'msg' => '添加成功！'
            ];
        }
        return response()->json($jsonData);
    }

    /**
     * @Function: 编辑具体题目的视图，包含该题目的信息
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param $id  PS:此处的id指的是题目的数据库ID
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editQuestion($id) {
        $DataTemp = new Databases();
        $info = $DataTemp->getTheQuestion($id);
        return view('Admin.Database.editQuestion',
            [
                'info' => $info[0],
            ]);
    }

    /**
     * @Function: 编辑题目后的提交
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editQuesHandle(Request $request) {
        $input = $request->all();  //获取所提交的所有的数据
        $id = $input['id'];
        $data = [
            'question' => $input['content'],
            'difficult' => $input['level'],
            'update_time' => time(),
            'comment' => $input['comment'],
        ];
        if(Input::has('select')) {
            $data['select'] = $input['select'];
            $data['option_a'] = $input['option_a'];
            $data['option_b'] = $input['option_b'];
            $data['option_c'] = $input['option_c'];
            $data['option_d'] = $input['option_d'];
        }else {
            $data['answer']  = $input['answer'];
        }
        $result = Databases::find($id);
        if($result->update($data)) {
            $jsonData = [
                'success' => true,
                'msg' => '更新成功！'
            ];
        }else {
            $jsonData = [
                'success' => false,
                'msg' => '更新失败！'
            ];
        }
        return response()->json($jsonData);
    }

    /**
     * @Function: 删除题目，直接删除
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteQues(Request $request) {
        $id = Input::get('id');
        $result = Databases::find($id);
        if($result->delete()) {
            $data = array(
                'success' => true,
                'msg' => '删除成功！'
            );
        }else {
            $data = array(
                'success' => false,
                'msg' => '删除失败！'
            );
        }
        return response()->json($data);
    }


}
