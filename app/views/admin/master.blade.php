@extends('layouts.master')

@section('title'){{{ $title or '管理后台' }}}@stop

@section('css')
<link rel="stylesheet" href="/css/admin/common.css">
@append

@section('banner')
            <div class="row-fluid banner">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/manage">后台首页</a></li>
                                <li><a href="/manage/news">新闻管理</a></li>
                                <li><a href="/manage/contest">竞赛管理</a></li>
                                <li><a href="/manage/account">帐号管理</a></li>
                                <li><a href="#/manage/statistics">综合统计</a></li>
                                <li><a href="/manage/config">其他信息</a></li>
                                <li><a href="/logout"><strong>退出登录</strong></a></li>
                            </ul>
                            <div class="nav navbar-nav navbar-right">
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="全站搜索">
                                    </div>
                                    <button type="submit" class="btn btn-default">搜索</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
@stop

@section('main')
    <div class="col-md-2">
        <div class="sidebar">
        <p id="sidebar_1">操作菜单</p>
        <hr />
        <div class="sideNav">
            @section('sidebar')
                <p><a href="/manage/">后台首页</a></p>
                <p><a href="/manage/news">新闻管理</a></p>
                <p><a href="/manage/contest">竞赛管理</a></p>
                <p><a href="/manage/account">账号管理</a></p>
                <p><a href="/manage/#statistics">综合信息</a></p>
                <p><a href="/manage/config">其他信息</a></p>
            @show
        </div>
        </div>
    </div>
    @section('functionArea')
    <div class="col-md-8 col-md-offset-1">
        <div class="functionArea">
            <p class="red strong">{{Session::get('realName', '你好')}}，欢迎登陆管理后台！</p>
            <p>请在顶部导航栏和左侧菜单栏选择你需要进行的操作。</p>
        </div>
    </div>
    @show
@stop