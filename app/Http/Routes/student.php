<?php
// 命名空间为‘Home’，url路由前缀为‘home’，
Route::group(['prefix' => 'home','namespace'=>'Home'],function() {
	Route::any('/login','LoginController@login');
    Route::any('/checkLogin','LoginController@checkLogin');
    Route::get('/testmenu','LoginController@testmenu');
});
