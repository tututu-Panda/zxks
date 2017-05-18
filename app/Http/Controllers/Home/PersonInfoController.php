<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Home\Student;

/**
 * Class PersonInfoController
 * @package App\Http\Controllers\Home
 * 学生端管理个人基本信息页面
 */
class PersonInfoController extends Controller
{



    /**
     * @Function: 上传学生头像
     * @Author: xuanhao
     * @DateTime: ${DATE} ${TIME}
     *
     */
    public function uploadHeadImg(Request $request)
    {
        if ($request->isMethod('post')) {
            $file = $request->file('Filedata');
            // 文件是否上传成功
            if ($file->isValid()) {
                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                // 上传文件
                $filename = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                $path = $file->move('uploads/headImgs',$filename);
                // 使用我们新建的uploads本地存储空间（目录）
                //$bool = Storage::disk('uploads')->put($filename, file_get_contents($realPath));
                $destinationPath = 'uploads/headImgs/';
                $stu_account = session('home_account');
                $info = Student::where('account',$stu_account)->first();
                $info->photo = asset($destinationPath.$filename);
                $info->save();
                $arr = [
                    'result' => true,
                    'imgurl' => asset($destinationPath.$filename),
                ];
                return json_encode($arr);
                //return response()->json($arr);
            }
        }

    }





}
