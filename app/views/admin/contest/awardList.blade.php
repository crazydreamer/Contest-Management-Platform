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
                <th>状态</th>
                <th>操作</th>
                </thead>
                @foreach ($lists as $list)
                <tr class="{{$list->awarded ? 'success' : ''}}">
                    <th>{{ $list->contest_id }}</th>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->awarded ? '已颁奖' : '未颁奖' }}</td>
                    <td><a href="/manage/contest/award/{{ $list->contest_id }}">{{ $list->awarded ? '修改' : '发布' }}获奖名单</a></td>
                </tr>
                @endforeach
            </table>
            <?php echo $lists->links(); ?>
    </div>
</div>
@stop