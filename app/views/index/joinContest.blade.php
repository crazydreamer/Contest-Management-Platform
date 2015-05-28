@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('title')
在线报名
@stop

@section('javascript')
    <script>
        function attend(id) {
            if (confirm('确定报名参赛？'))
                $.ajax({
                    url: '/contest/join',
                    type: 'POST',
                    data: 'contestId=' + id,
                    success: function (result) {
                        alert(result);
                        //window.location.href = window.location.href;
                    }
                });
        }
    </script>
@append

@section('main')
<div class="col-md-6 col-md-offset-3" id="formAttendContest">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="inputContest" class="col-sm-3 control-label">当前可选竞赛</label>
            <div class="col-sm-9 dropdown">
                <select name="contestId" id="inputContest" class="form-control">
                    <option value="0">请选择竞赛</option>
                    @foreach($contestList as $contest)
                        <option value="{{$contest->contest_id}}">{{$contest->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="button" onclick="attend(document.getElementById('inputContest').value)" class="form-control">在线报名</button>
            </div>
        </div>
    </form>
</div>
@overwrite
