@extends('admin.master')

@section('title')
竞赛管理
@stop

@section('css')
@append

@section('sidebar')
    <p><a href="/manage/contest/list">全部竞赛</a></p>
    <p><a href="/manage/contest/serial">系列赛事</a></p>
    <p><a href="/manage/contest/new">创建竞赛</a></p>
    <p><a href="/manage/contest/winners">获奖名单</a></p>
@stop

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
    </div>
</div>
@stop