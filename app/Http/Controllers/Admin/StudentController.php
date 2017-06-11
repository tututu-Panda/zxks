<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Home\Student;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class StudentController extends Controller
{

    /**
     * @Function: 获取首页数据
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $requestPage = $request->get('requestPage',1); //获取请求的页码数，默认为1
        $studentList_t = Student::all()->toArray();
        $total = Student::where('id','>',0)->count(); //统计该学生的所有成绩信息条数
        $pages = 0;     //初始化页数变量
        $rows = 5;      //设置每页显示的条数
        if($total%$rows == 0) {
            $pages = $total/$rows;
        }else {
            $pages = intval($total/$rows + 1);
        }
        //将查询后的所有符合条件的数据放入集合，然后根据页数来对数据进行划分获取，数组索引
        //collect集合和slice切片选择页数内容
        $studentList = collect($studentList_t)->slice(($requestPage -1)*$rows, $rows);

        return view('Admin/Student/index',compact('studentList','pages','requestPage'));
    }


    /**
     * @Function: 添加学生
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        $input = $request->all();
        //1.验证账户是否为空（js已经判断）;2.验证账号是否已经存在
        $this->validate($request, [
            'account' => 'required|unique:students,account',
        ],[
            'account.required' => '账户必须',
            'account.unique' => '账户已经存在',
            'name.required' => '姓名必须',
        ]);
        //插入数据库
        $addData = [
            'account' => $input['account'],
            'name' => $input['name'],
            'password' => Hash::make(123456), //Hash加密
            'sex' => $input['sex'],
            'info' => $input['info'],
            'create_time' => time()
        ];
        $result = Student::create($addData);        //添加学生
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
     * @Function: 重置密码，默认为123456
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Http\JsonResponse
     */
   public function resetPs() {
       $id = Input::get('id');          //寻找到该学生
       $result = Student::find($id);
       $result->password = Hash::make(123456);
       if($result->save()) {
           $data = array(
               'success' => true,
               'msg' => '成功！'
           );
       }else {
           $data = array(
               'success' => false,
               'msg' => '失败！'
           );
       }
       return response()->json($data);
   }

    /**
     * @Function: 删除该学生
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy()
    {
        $id = Input::get('id');
        $result = Student::find($id);
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
