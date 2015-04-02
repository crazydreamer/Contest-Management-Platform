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

// 首页
Route::get('/', 'IndexController@index');
// 新闻正文
Route::get('/news/{id}', 'IndexController@news')->where('id', '[1-9]\d*');
// 新闻中心&分类新闻
Route::get('/news/list', 'IndexController@newsCenter');
Route::get('/news/list/{cat_id}', 'IndexController@newsCenter')->where('cat_id', '[1-9]\d*');
// 用户注册页面
Route::get('/signup', function() {
    return View::make('index.signup');
});
Route::post('/signup', 'IndexController@signup');
// 后台路由临时存放于此

Route::controller('/manage/config', 'AdminController');
Route::get('/manage', function() {
    // 此处需添加权限验证路由
    return View::make('admin.master');
});

Route::controller('/manage/news', 'NewsController');

