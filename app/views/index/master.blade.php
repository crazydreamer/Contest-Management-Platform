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
                    <p>{{$contest->name}}</p>
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
        <div class="moduleContent">
            <div class="">
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/0e55cfefe28896255b3a64958daf81b3.zip">移动互联网应用安全动态监控沙盒分析测评...</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">基于安全二维码的快递隐私保护系统</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">“隐形”U盘</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">面向信息安全的快递物流管理系统</a>
                </div>
            </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">基于步态识别的身份认证系统</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">基于人脸识别的身份认证系统的研究与应用...</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">面向Android智能移动平台的信息隐...</a>
                </div>
                <div class="col-md-3 worksBox">
                    <img class="WorksImgSmall" src="/img/index_down_icon.png"><br />
                    <a href="/down/stu_work/b273d24ba75beacc6cabede1320c3feb.zip">基于Android的敏感数据传播检测系...</a>
                </div>
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
            <div class="winnerList">
            <marquee scrollAmount=2 direction=up height="100%" vspace="0px">
                {{ $winnerList }}
            </marquee>
            </div>
        </div>
    </div>
</div>
@stop
