<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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
        return "<h1>个人信息首页</h1>";
    }

}
