@extends('layouts.master')

@section('title')
竞赛列表
@stop

@section('css')
@parent
<link rel="stylesheet" href="/css/index.css">
@stop

@section('main')
<div class="row-fluid">
    <div class="col-md-2">
        <div class="sidebar">
            <p id="sidebar_1">竞赛列表</p>
            <hr />
            <div class="sideNav">
                <p><a href="/contest/list">最新竞赛</a></p>
                <p><a href="/contest/list">竞赛查询</a></p>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-1">
        <table class="table">
            @foreach ($list as $contest)
            <tr><td>> {{$contest->name}}</td></tr>
            @endforeach
        </table>
        <?php echo $list->links(); ?>
    </div>
</div>
@stop