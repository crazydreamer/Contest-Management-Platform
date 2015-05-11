@extends('layouts.master')

@section('title')
用户注册
@stop

@section('css')
    <link rel="stylesheet" href="/css/index.css">
@stop

@section('javascript')
    <script type="text/javascript">
        function signUp() {
            var valid = true;
            var pass = document.getElementById("inputPassword").value;
            var checkpass = document.getElementById("inputPasswordConfirm").value;

            if (pass != checkpass) {
                alert("两次密码输入不一致！");
                valid = false;
            }

            if (document.getElementById('inputDepartment').value == 0 && valid) {
                alert("请选择学院！");
                valid = false;
            }

            if (valid == true) {
                document.getElementById("signupForm").submit();
            }
        }
    </script>
@stop

@section('main')
<div class="col-md-8 col-md-offset-2">
    <p id="signupTitle">用户注册</p>
    <form id="signupForm" class="form-horizontal" method="POST" action="/signup">
        <div class="form-group">
            <label for="inputStuID" class="col-sm-3 control-label">学号</label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="stuId" id="inputStuID" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label for="inputName" class="col-sm-3 control-label">姓名</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="realName" id="inputName" placeholder="请使用中文的真实姓名">
                <p class="help-block">If you do not have a Chinese name, please use 留学生 as your name.</p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPhone" class="col-sm-3 control-label">联系电话</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="phone" id="inputPhone" placeholder="">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-sm-3 control-label">密码</label>
            <div class="col-sm-9">
                <input type="password" class="form-control" name="password" id="inputPassword" placeholder="请输入密码">
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
                <select name="departmentId" id="inputDepartment" class="form-control">
                    <option value="0">请选择学院</option>
                    @foreach($departmentList as $department)
                    <option value="{{$department->department_id}}">{{$department->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="button" onclick="signUp()" class="form-control">注册</button>
            </div>
        </div>
    </form>
</div>
@overwrite
