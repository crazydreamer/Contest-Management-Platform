<?php

// 首页
Route::get('/', 'IndexController@index');
// 新闻正文
Route::get('/news/{id}', 'IndexController@news')->where('id', '[1-9]\d*');
// 新闻中心&分类新闻
Route::get('/news/list', 'IndexController@newsCenter');
Route::get('/news/list/{cat_id}', 'IndexController@newsCenter')->where('cat_id', '[1-9]\d*');
// 竞赛列表
Route::get('/contest/list', 'IndexController@contestCenter');

Route::group(array('before' => 'checkLogin'), function()
{
    // 在线报名
    Route::get('/contest/join', 'ContestController@listToJoin');
    Route::post('/contest/join', 'ContestController@join');
    // 作品提交
    Route::get('/works/upload', 'ContestController@contestToUpload');
    Route::post('/works/upload', 'ContestController@uploadWorks');
});

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

Route::post('/upload/{type}', 'UtilsController@upload')->where('id', '[0-1]');

Route::get('/down/{type}/{filename}', 'UtilsController@download');