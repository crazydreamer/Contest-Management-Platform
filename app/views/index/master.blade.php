@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('banner')
            <div class="row-fluid banner">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">首页</a></li>
                                <li><a href="#">最新公告</a></li>
                                <li><a href="#">竞赛列表</a></li>
                                <li><a href="#">在线报名</a></li>
                                <li><a href="#">作品提交</a></li>
                                <li><a href="#">获奖作品</a></li>
                                <li><a href="#">优秀作品</a></li>
                                <li><a href="#">综合查询</a></li>
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
                </div>
                </nav>
            </div>
@stop

@section('main')
     <div class="row-fluid text-center">
                <div class="col-md-4">
                    <div class="indexModule indexModuleLine1" id="">
                        <div class="moduleHeader">
                            <p class="headerTitle">
                                竞赛列表
                            </p>
                        </div>
                        <div class="moduleContent">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="indexModule indexModuleLine1" id="">
                        <div class="moduleHeader">
                            <p class="headerTitle">
                                新闻公告
                            </p>
                        </div>
                        <div class="moduleContent">
                            <a href='news/123'>测试连接</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="indexModule indexModuleLine1" id="userPanel">
                        <div class="moduleHeader">
                            <p class="headerTitle">
                                平台登录
                            </p>
                        </div>
                        <div class="moduleContent">
                            {{ Form::open(array('url' => 'foo/bar', 'name' => 'test', 'role' => 'form', 'class' => 'form-horizontal')) ;}}
                            <div class="form-group">
                                {{Form::label('username', '帐号', $attributes = array('class' => 'col-xs-3 control-label'));}}
                                <div class="col-xs-8">
                                    {{Form::text('username', $value = null, $attributes = array(
                                'placeholder' => 'test',
                                'id' => 'username',
                                'class' => 'form-control'));}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{Form::label('password', '密码',  $attributes = array('class' => 'col-xs-3 control-label'));}}
                                <div class="col-xs-8">
                                    {{Form::password('password', $attributes = array(
                                 'id' => 'password',
                                 'class' => 'form-control'));}}
                                </div>
                            </div>
                            <!--此处添加验证码-->
                            <div class="form-group">
                                {{Form::submit('登录', $attributes = array(
                                 'id' => 'submit',
                                 'class' => 'form-control' ));}}
                            </div>
                            {{ Form::close(); }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="indexModule indexModuleLine2" id="">
                    <div class="moduleHeader">
                        <p class="headerTitle">
                            获奖作品展示
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="indexModule indexModuleLine2" id="">
                    <div class="moduleHeader">
                        <p class="headerTitle">
                            获奖名单
                        </p>
                    </div>
                </div>
            </div>
@stop
