@extends('admin.account.master')

@section('title')
创建账号
@stop

@section('css')
@append

@section('javascript')
@append

@section('functionArea')
<div class="col-md-6 col-md-offset-2">
    <div class="functionArea">
        <form class="form-horizontal" role="form" action="/manage/account/add" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-3">账号类型</label>
                <div class="controls col-sm-9">
                    <label class="radio-inline">
                        <input type="radio" id="inlineRadio1" name="role" value="3">竞赛评委
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="inlineRadio2" name="role" value="4">竞赛管理员
                    </label>
                    <label class="radio-inline">
                        <input type="radio" id="inlineRadio2" name="role" value="6">站点管理员
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label for="inputName" class="control-label col-sm-3">真实姓名</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="realName" id="inputName" placeholder="">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPhone" class="control-label col-sm-3">联系方式</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" name="phone" id="inputPhone">
                    <p class="help-block">请输入手机号或028开头8位固话，如02861830114。</p>
                </div>
            </div>

            <div class="form-group">
                <label for="inputDepartment" class="control-label col-sm-3">所属部门</label>
                <div class="col-sm-9 dropdown">
                    <select name="departmentId" id="inputDepartment" class="form-control">
                        <option value="0">请选择学院</option>
                        @foreach($list as $department)
                            <option value="{{$department->department_id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="inputAccount" class="control-label col-sm-3">登录账号</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="account" id="inputAccount">
                </div>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="control-label col-sm-3">设置密码</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="password" id="inputPassword">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <input type="submit" class="form-control" value="创建账号">
                </div>
            </div>
        </form>
    </div>
</div>
@stop