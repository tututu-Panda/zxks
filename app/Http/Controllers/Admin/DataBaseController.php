<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 题库管理面板
 * Class DataBaseController
 * @package App\Http\Controllers\Admin
 */
class DataBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "<h1>题库管理</h1>";
    }


}
