<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Home\Student;
use DB;
use Illuminate\Support\Facades\Hash;
class IndexController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('home');
//    }
    /**
     * @Function: 登录后前台首页模板视图
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $stu_account = session('home_account');
        $info = Student::where('account',$stu_account)->first()->toArray();
        // 存储用户session
        session(['stu_name_s' => $info['name']]);
        return view('Home.Index.index');
    }

    /**
     * @Function: 显示个人资料面板
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function personInfo() {
        $stu_account = session('home_account');
        $info = Student::where('account',$stu_account)->first()->toArray();
        return view('Home.Index.personInfo',['info' => $info]);
    }

    /**
     * @Function: 修改密码页面
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function modifyPsw() {
        return view('Home.Index.modifyPsw');
    }

    /**
     * @Function: 修改密码的提交
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function modifyPswHandle(Request $request) {
        $input = $request->all();
        $oldPsw = $input['oldPassword'];  //获取输入的旧密码
        $stu_account = session('home_account');  //获取登录的session账户
        //p($oldPsw);die;
        $checkPsw = Student::where('account',$stu_account)->select('password')->get()->toArray();
        //检查旧密码输入是否正确
        if(Hash::check($oldPsw,$checkPsw[0]['password'])) {
            //验证通过，修改密码
            $newPsw = $input['newPassword'];
            $new_hash = Hash::make($newPsw); //Hash加密
            $temp = ['password' => $new_hash]; //转化为数组
            $status = Student::where('account',$stu_account)->update($temp);
            if($status) {
                $return = array(
                    'status' => true,
                    'msg' => '更新成功！',
                );
            }else{
                $return = array(
                    'status' => false,
                    'msg' => '更新失败！',
                );
            }
        }else {
            // 验证失败，返回错误
            $return = array(
                'status' => false,
                'msg' => '原密码错误！',
            );
        }
        return response()->json($return);

    }

    /**
     * @Function: 编辑个人资料的提交
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function editStuHandle(Request $request) {
        $input = $request->all();
        $id = $input['id'];
        $stu = Student::find($id);
        $stu->name = $input['name'];
        $stu->email = $input['email'];
        $stu->sex = $input['sex'];
        $stu->phone = $input['phone'];
        if($stu->save()) {
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

}
