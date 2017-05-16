<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function examIndex()
    {
        return view('Home.Exam.examIndex');
    }
    public function examTest() {
        return view('Home.Exam.examTest');
    }


}
