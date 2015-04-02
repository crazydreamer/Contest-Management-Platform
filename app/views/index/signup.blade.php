@extends('layouts.master')

@section('title')
用户注册
@stop

@section('main')
<div class="col-md-8 col-md-offset-2">
    <form class="form-horizontal" method="POST" action="/signup">
        <div class="form-group">
            <label for="inputStuID" class="col-sm-3 control-label">学号</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" id="inputStuID" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-3 control-label">密码</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPassword" placeholder="请输入密码">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPasswordConfirm" class="col-sm-3 control-label">确认密码</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" id="inputPasswordConfirm" placeholder="请再次确认密码">
            </div>
        </div>
        <div class="form-group">
            <label for="inputDepartment" class="col-sm-3 control-label">学院</label>
            <div class="col-sm-9 dropdown">
                <select id="inputDepartment" class="form-control">
                    <option>请选择学院</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="form-control">注册</button>
            </div>
        </div>
    </form>
</div>
@overwrite
