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
    Route::get("/sysuser/index",'SysuserController@index');
//    题库管理
    Route::get("/DataBase/index",'DataBaseController@index');
//    成绩统计
    Route::get("/Score/index",'ScoreController@index');
//    试卷列表
    Route::get("/Paper/index",'PaperController@index');





//
});