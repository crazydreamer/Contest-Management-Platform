@extends('admin.master')

@section('title')
新闻管理
@stop

@section('css')
<link rel="stylesheet" href="/css/admin/news.css">
@append

@section('sidebar')
<p><a href="/manage/news">新闻列表</a></p>
<p><a href="/manage/news/new">发布新闻</a></p>
<p><a href="/manage/news/category">分类管理</a></p>
<!--<p>新闻审核</p>-->
@stop

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
    </div>
</div>
@stop