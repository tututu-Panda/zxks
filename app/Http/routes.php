<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// 后台路由设置
require __DIR__.'/Routes/admin.php';


//前台路由设置
require __DIR__.'/Routes/student.php';


Route::get("/",function (){
    return redirect()->route('Home.Index.index');
});