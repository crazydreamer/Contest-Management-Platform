@extends('admin.master')

@section('title')
    其他信息
@stop

@section('main')
    <div class="col-md-2">
        <div class="sidebar">
            <p id="sidebar_1">操作菜单</p>
            <hr />
            <div class="sideNav">
                @section('sidebar')
                    <p><a href="/manage/config/department">院系维护</a></p>
                @show
            </div>
        </div>
    </div>
@section('functionArea')
    <div class="col-md-8 col-md-offset-1">
        <div class="functionArea">
        </div>
    </div>
@show
@stop