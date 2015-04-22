@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/index.css">
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
                @foreach ($contestList as $contest)
                    <p class="test">{{$contest->name}}</p>
                @endforeach
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
                @foreach ($newsList as $news)
                <p><a id='newsCategory' href="/news/list/{{$news->cat_id}}">{{$news->name}}</a>&nbsp;|&nbsp;<a id="newsTitle" href="/news/{{$news->news_id}}" title='{{ $news->title }}'>{{$news->short_title}}</a></p>
                @endforeach
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
                {{ Form::open(array('url' => '/login', 'name' => 'test', 'role' => 'form', 'class' => 'form-horizontal')) }}
                <div class="form-group">
                    {{Form::label('username', '帐号', $attributes = array('class' => 'col-xs-3 control-label indexLogin'));}}
                    <div class="col-xs-8">
                        {{Form::text('username', $value = null, $attributes = array(
                                'id' => 'username',
                                'class' => 'form-control indexLogin',));}}
                    </div>
                </div>
                <div class="form-group">
                    {{Form::label('password', '密码',  $attributes = array('class' => 'col-xs-3 control-label indexLogin'));}}
                    <div class="col-xs-8">
                        {{Form::password('password', $attributes = array(
                                 'id' => 'password',
                                 'class' => 'form-control indexLogin'));}}
                    </div>
                </div>
                <!--此处添加验证码-->
                <div class="form-group">
                    {{Form::submit('登录', $attributes = array(
                                 'id' => 'submit',
                                 'class' => 'form-control indexLogin' ));}}
                </div>
                <div class="form-group">
                    {{Form::button('注册', $attributes = array(
                                 'id' => 'signup',
                                 'onclick' => 'location=\'/signup\'',
                                 'class' => 'form-control indexLogin' ));}}
                </div>
                {{ Form::close() }}
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
        <div class="moduleContent">
            <marquee scrollAmount=2 direction=up>
                {{ $winnerList }}
            </marquee>
        </div>
    </div>
</div>
@stop
