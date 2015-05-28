@extends('admin.contest.master')

@section('title')
    获奖名单
@stop

@section('javascript')
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <p class="red">当前共有{{ count($list) }}名同学通过在线报名参加了比赛</p>
        <table class="table table-hover text-center">
            <thead>
            <th>用户ID</th>
            <th>姓名</th>
            <th>学号</th>
            <th>报名时间</th>
            </thead>
            @foreach ($list as $record)
            <tr>
                <th>{{ $record->user_id }}</th>
                <td>{{ $record->realname }}</td>
                <td>{{ $record->stu_id }}</td>
                <td>{{ $record->create_time }}</td>
            </tr>
            @endforeach
        </table>
        <?php echo $list->links(); ?>
    </div>
</div>
@stop