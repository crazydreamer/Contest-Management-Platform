@extends('layouts.master')

@section('css')
@parent
<link rel="stylesheet" href="/css/news.css">
@stop
@section('main')

<div class="row-fluid">
    <div class="col-md-12">
        <div class="newsTitle">
            这里是新闻{{{$id or '1'}}}标题
        </div>
        
        <div class="newsInfo">
            <p>
                分类：{{{ $category or '默认' }}}
                &nbsp;&nbsp;&nbsp;&nbsp;
                已读：{{{ $click or '0' }}}
                &nbsp;&nbsp;&nbsp;&nbsp;
                发布日期：{{{ $time or '1970-01-01' }}}
                &nbsp;&nbsp;&nbsp;&nbsp;
                作者：{{{ $author or '管理员' }}}
            </p>
        </div>
        
        <hr class='hrNews' />
        
        <div class="newsContent">
            {{$newsContent}}
        </div>
    </div>
</div>
@stop