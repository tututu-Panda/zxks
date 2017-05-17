<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sysuser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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


//        // 格式化图片名称
//        $file_name = $file['tmp_name'];
//        // 执行move方法
//        $status = move_uploaded_file($file_name,$destinationPath);
//
//        // 修改图片大小
////        Image::make($destinationPath . $file_name)->fit(200)->save();
//        if($status) {
//            $return = array(
//                'data' => $destinationPath,
//                'status' => 'success',
//            );
//        }
        return response()->json($return);
    }

}
