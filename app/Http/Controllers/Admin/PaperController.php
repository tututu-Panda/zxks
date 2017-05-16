<?php

namespace App\Http\Controllers\Admin;

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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "<h1>试卷列表</h1>";
    }


}
