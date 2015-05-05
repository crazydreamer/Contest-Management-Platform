@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('title')
用户登陆
@stop

@section('main')
<div class="col-md-6 col-md-offset-3 loginForm">
    <p id="loginTitle">用户登录</p>
    <form class="form-horizontal" method="POST" action="/login">

        <div class="form-group">
            <label for="inputUsername" class="col-sm-3 control-label">账号</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="inputUsername" name="username">
                <p class="help-block">学生登陆请使用学号登陆，其他账号请使用用户名登陆</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-3 control-label">密码</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword" name="password">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="form-control">登陆</button>
            </div>
        </div>
    </form>
</div>
@overwrite
