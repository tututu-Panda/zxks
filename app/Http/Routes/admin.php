<?php




// 命名空间为‘Sysuser’，url路由前缀为‘admin’，
Route::group(['namespace'=>'Admin','prefix'=>'admin'],function() {
//    用户登录模板
    Route::get('/login','LoginController@Login');
//    用户登录验证
    Route::post('/loginCheck','LoginController@LoginCheck');
//    获得验证码
    Route::get('/login/captcha/{tmp}','LoginController@captcha');
//    验证验证码
    Route::post('/checkVerify','LoginController@checkVerify');
});


// 通过中间件’auth’，验证功能，命名空间为‘Sysuser’，url路由前缀为‘admin’
Route::group(['middleware'=>'auth','namespace'=>'Admin','prefix'=>'admin'],function(){
//    退出登录
    Route::get('/logout','LoginController@LogOut');
//    登录首页显示
    Route::get('/','IndexController@Index');


//    个人信息管理
    Route::get("/Sysuser/index",'SysuserController@index');
    Route::post("/Sysuser/upload",'SysuserController@uploadPhoto');
    Route::post("/Sysuser/update",'SysuserController@updateSysuer');
    Route::get("/Sysuser/chanpass/{id}",function ($id){
        return view('Admin.Sysuser.changepass')->with('id',$id);
    });

    Route::post("/Sysuser/chanpass",'SysuserController@changepass');


//    题库管理
    Route::get("/DataBase/index",'DataBaseController@index');
    Route::any("/DataBase/editType/{id}","DataBaseController@editType");
    Route::post("/DataBase/editTypeHandle","DataBaseController@editTypeHandle");
    Route::post("/DataBase/addTypeHandle","DataBaseController@addTypeHandle");
    Route::any("/DataBase/deleteType","DataBaseController@deleteType");
    Route::any("/DataBase/baseDetail/{id}","DataBaseController@baseDetail");
    Route::any("/DataBase/addQuestion/{id}","DataBaseController@addQuestion");
    Route::post("/DataBase/addQuesHandle","DataBaseController@addQuesHandle");
    Route::any("/DataBase/editQuestion/{id}","DataBaseController@editQuestion");
    Route::post("/DataBase/editQuesHandle","DataBaseController@editQuesHandle");
    Route::any("/DataBase/deleteQues","DataBaseController@deleteQues");

//    成绩统计
    // 成绩查询
    Route::get("/Score/index",'ScoreController@index');
    // 根据学科获得试卷
    Route::post("/Score/getpaper",'ScoreController@getPaper');
    // 成绩统计
    Route::get('/Score/total','ScoreController@total');
    // 成绩详细信息
    Route::get('/Score/details','ScoreController@details');



//    试卷列表
    Route::get("/Paper/index",'PaperController@index');
    Route::post("/Paper/action",'PaperController@usePaper');






//
});