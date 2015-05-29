@extends('admin.master')

@section('title')
竞赛管理
@stop

@section('css')
@append

@section('sidebar')
    <p><a href="/manage/account/add"><strong>创建账号</strong></a></p>
    <p><a href="#">账号列表</a></p>
    <p><a href="#">查找账号</a></p>
    <p><a href="#">管理账号</a></p>
@stop

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
    </div>
</div>
@stop