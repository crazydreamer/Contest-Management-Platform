@extends('admin.contest.master')

@section('title')
创建竞赛
@stop

@section('css')
    <link rel="stylesheet" href="/css/bootstrap-datetimepicker.min.css">
@append

@section('javascript')
    <script src="/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.zh-CN.js"></script>
    <script type="text/javascript">
        $(function() {
            $('.datetimepicker').datetimepicker({
                language:'zh-CN',
                format: 'yyyy-mm-dd hh:ii'
            });
        })

        function show(target) {
            document.getElementById(target).classList.remove('hidden');
        }

        function hide(target) {
            document.getElementById(target).classList.add('hidden');
        }

    </script>
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <form class="form-horizontal" role="form" action="/manage/contest/new" method="POST">
            <fieldset>
                <div id="legend" class="form-group">
                    <legend class="">竞赛创建向导</legend>
                </div>
                <div class="form-group">
                    <label class="control-label">竞赛分类</label>
                    <div class="controls">
                        <label class="radio-inline">
                            <input type="radio" id="inlineRadio1" name="cat" onclick="show('serialOption')"> 系列竞赛
                        </label>
                        <label class="radio-inline">
                            <input type="radio" id="inlineRadio2" name="cat" onclick="hide('serialOption')" checked> 单次竞赛
                        </label>
                    </div>
                    <input class="hidden form-control" name="level" value="2" readonly>
                    <p class="help-block">系列竞赛：周期性举办的学科竞赛。单次比赛：临时性，非长期举办的学科竞赛。</p>
                </div>

                <div class="form-group hidden" id="serialOption">
                    <label class="control-label">所属系列赛事</label>
                    <div class="controls">
                        <select class="form-control" name="parent_id">
                            <option value="0">选择所属系列赛事</option>
                        @foreach($parentContests as $contest)
                            <option value="{{$contest->contest_id}}">{{$contest->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <p class="help-block">请选择所属系列赛事并完善届次信息。若以上选项中没有找到该竞赛，请<a href="#">创建</a>该系列竞赛。</p>
                </div>

                <div class="form-group">
                    <label class="control-label" for="name">竞赛名称</label>
                    <div class="controls">
                        <input type="text" class="form-control" id="name" name="name">
                        <p class="help-block">此处请输入准确的竞赛名称</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="name">竞赛描述</label>
                    <div class="controls">
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <p class="help-block">请输入竞赛简介，若没有可留空</p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="start_time">选择比赛开始时间</label>
                    <input class="datetimepicker" type="text" value="" name="start_time" id="start_time" readonly>
                </div>

                <div class="form-group">
                    <label class="control-label" for="end_time">选择比赛结束时间</label>
                    <input class="datetimepicker" type="text" value="" name="end_time" id="end_time" readonly>
                </div>

                <div class="form-group">
                    <label class="control-label" for="attend_deadline">在线报名截至时间</label>
                    <input class="datetimepicker" type="text" value="" name="attend_deadline" id="attend_deadline" readonly>
                    <p class="help-block">如果比赛不需要支持在线报名，请将报名截止时间设置为与开始时间相同。</p>
                </div>

                <div class="form-group">
                    <label class="control-label">是否需要在线提交作品</label>
                    <div class="controls">
                        <label class="radio-inline">
                            <input type="radio" name="withWorks" value="1" onclick="show('worksOption')">需要
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="withWorks" value="0" onclick="hide('worksOption')">不需要
                        </label>
                    </div>
                    <p class="help-block">需要在线提交作品的比赛将会要求用户将参赛作品在线上传，如果不需要请勾选“不需要”。</p>
                </div>

                <div class="form-group hidden" id="worksOption">
                    <label class="control-label" for="works_deadline">在线作品提交截止时间</label>
                    <input class="datetimepicker" type="text" value="" name="works_deadline" id="works_deadline" readonly>
                </div>

                <div class="form-group">
                    <label class="control-label" for="inputDepartment">主办单位</label>
                    <div class="controls dropdown">
                        <select id="inputDepartment" class="form-control" name="host">
                            <option>请选择主办单位</option>
                            @foreach($departmentList as $department)
                                <option value="{{$department->department_id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="form-control" value="创建竞赛">
                </div>
            </fieldset>
        </form>
    </div>
</div>
@stop