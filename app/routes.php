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
// 竞赛列表
Route::get('/contest/list', 'IndexController@contestCenter');
// 在线报名
Route::get('/contest/join', 'ContestController@listToJoin');
Route::post('/contest/join', 'ContestController@join');
// 用户注册
Route::get('/signup', 'IndexController@showSignUp');
Route::post('/signup', 'IndexController@signUp');
// 用户登录&退出
Route::get('/login', function() {
    return View::make('index.login');
});
Route::post('/login', 'IndexController@login');
Route::get('/logout', 'IndexController@logout');

/*****************    后台路由    *****************/

// 后台权限验证路由
Route::filter('admin', function()
{
    if (Session::has('userId') && Session::has('role')) {
        if (Session::get('role') == Config::get('constant.roles.siteAdmin')) {
            // 权限验证成功
        } else {
            return UtilsController::redirect('您当前用户组没有后台操作权限，请重新登陆', '/login', 1);
        }
    } else {
        return UtilsController::redirect('您尚未登陆，请登录后进行操作', '/login', 1);
    }
});

Route::group(array('before' => 'admin'), function()
{
    Route::get('/manage', function() {
        return View::make('admin.master');
    });

    Route::controller('/manage/news', 'NewsController');
    Route::controller('/manage/contest', 'ContestController');
    Route::controller('/manage/account', 'AccountController');
    Route::controller('/manage/config', 'AdminController');
}
);

/*****************    工具接口    *****************/

Route::post('/upload', 'UtilsController@upload');

Route::get('/down/{type}/{filename}', 'UtilsController@download');