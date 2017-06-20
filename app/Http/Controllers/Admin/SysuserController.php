<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EditSysuserRequest;
use App\Models\Sysuser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;


/**
 * 后台用户管理面板
 * Class SysuserController
 * @package App\Http\Controllers\Admin
 */
class SysuserController extends Controller
{

    /**
     * 个人信息首页展示
     */
    public function index()
    {
        $user = session('account');
        $Sysuer = Sysuser::where('account',$user)
                            ->select('id','account','password','name','phone','sex','email','photo')
                            ->get()->toArray();
        return view('Admin.Sysuser.index')->with('user',$Sysuer[0]);
    }

    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 修改用户的头像信息
     */
    public function uploadPhoto(Request $request) {

        $file = $request->file('photo');
//        var_dump($file);

        // 得到缓存文件
        $clientName = $file -> getClientOriginalName();
        $tmpName = $file ->getFileName();
        // 得到缓存文件路径
        $realPath = $file -> getRealPath();
        // 得到后缀名
        $entension = $file -> getClientOriginalExtension();

        // 创建新的文件夹保存
        $Dict = date("Y-m-d");

        // 创建新的名称
        $newName = date("H:i:s");

        //将文件移动到public/uploads下
        $status = $file -> move('uploads/'.$Dict,$newName.".".$entension);

        if($status) {
            $route = asset("uploads/".$Dict."/".$newName.".".$entension);
            $return = array(
                'route' => $route,
                'status' => true,
            );
        }else{
            $route = asset("'/public/static/img/default.jpg'");
            $return = array(
                'route' => $route,
                'status' => false,
            );
        }

        return response()->json($return);
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 更新用户信息
     */
    public function updateSysuer(EditSysuserRequest $request) {
        $id = Input::get('id');
        $user = Sysuser::find($id);
        $status = $user->update($request->all());
        if($status){
            $return = array(
                'data' => '更新成功！',
                'status' => 'success'
            );
        }else {
            $return = array(
                'data' => '更新失败！',
                'status' => false
            );
        }
        return response()->json($return);
//        var_dump(Input::all());
//        exit();
    }


    /**
     * Created by
     * Author : pjy
     * Date : ${DATE}
     * Time : ${TIME}
     * 修改密码
     */
    public function changepass(Request $request) {
        // 获得id所对应的密码hash值
        $id = $request->get('id');
        $hashedPassword = Sysuser::where('id',$id)->select('password')->get()->toArray();
//        var_dump($hashedPassword);
//        exit();

        //获得输入框中的密码
        $password = $request->get('old_pass');
        if (Hash::check($password, $hashedPassword[0]['password'])) {
            // 验证成功，修改密码
            $newpass = $request->get('new_password');
            $new_hash = Hash::make($newpass);
            $status = Sysuser::where('id',$id)->update(['password'=>$new_hash]);
            if($status) {
                $return = array(
                    'status' => 'success',
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


}
