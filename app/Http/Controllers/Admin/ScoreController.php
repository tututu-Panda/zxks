<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

/**
 * 成绩管理面板
 * Class ScoreController
 * @package App\Http\Controllers\Admin
 */
class ScoreController extends Controller
{

    public function index()
    {
        return "<h1>成绩统计</h1>";;
    }


}
