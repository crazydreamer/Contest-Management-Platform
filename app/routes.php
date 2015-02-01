<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

Route::get('/', function() {
    return View::make('index.master');
});

Route::get('/news/{id}', 'IndexController@news')->where('id', '[0-9]+');;

// 后台路由临时存放于此

Route::get('/manage', function() {
    // 此处需添加权限验证路由
    return View::make('admin.master');
});

Route::controller('/manage/news', 'NewsController');

