<?php
// 命名空间为‘Home’，url路由前缀为‘home’，
Route::group(['prefix' => 'home','namespace'=>'Home'],function() {
	Route::any('/login','LoginController@login');
    Route::any('/checkLogin','LoginController@checkLogin');
    Route::get('/testmenu','LoginController@testmenu');
});


// 通过中间件’home’，验证功能，命名空间为‘Home’，url路由前缀为‘home’
Route::group(['middleware'=>'home','namespace'=>'Home','prefix'=>'home'],function(){
//    退出登录
    Route::get('/logout','LoginController@LogOut');
//    登录后首页显示
    Route::get('/index',['as' => 'Home.Index.index','uses' => 'IndexController@index']);

    Route::get('/modifyPsw','IndexController@modifyPsw');
    Route::get('/personInfo',['as' => 'Home.Index.personInfo','uses' => 'IndexController@personInfo']);
    Route::get('/examIndex',['as' => 'Home.Exam.examIndex', 'uses' => 'ExamController@examIndex']);
    Route::get('/gradeIndex','GradeController@gradeIndex');
    Route::get('/examTest','ExamController@examTest');


//
});