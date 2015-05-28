@extends('admin.contest.master')

@section('title')
    获奖名单
@stop

@section('javascript')
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
            <table class="table table-hover text-center">
                <thead>
                <th>id</th>
                <th>竞赛名称</th>
                <th>报名统计</th>
                </thead>
                @foreach ($lists as $list)
                <tr class="{{$list->attend_deadline === NULL ? '' : 'success'}}">
                    <th>{{ $list->contest_id }}</th>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->attend_deadline === NULL ? "未开通在线报名" : "<a href='/manage/contest/attendee/$list->contest_id'>查看报名情况</a>" ; }}</td>
                </tr>
                @endforeach
            </table>
            <?php echo $lists->links(); ?>
    </div>
</div>
@stop