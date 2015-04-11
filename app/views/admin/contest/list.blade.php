@extends('admin.contest.master')

@section('title')
    全部竞赛
@stop

@section('javascript')
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="newsList">
            <table class="table table-hover text-center">
                <thead>
                <th>id</th>
                <th>竞赛名称</th>
                <th>操作</th>
                </thead>
                @foreach ($lists as $list)
                <tr class="{{$list->status ? '' : 'warning'}}">
                    <th>{{ $list->contest_id }}</th>
                    <td>{{ $list->name }}</td>
                    <td>{{ $list->status ? '' :'<a onclick="sendAction(\'active\', ' . $list->news_id . ')">发布</a>' }} {{'<a href="/manage/news/edit?id=' . $list->news_id  . '">修改</a>' . ' ' . '<a onclick="sendAction(\'delete\', ' . $list->news_id . ')">删除</a>' }}</td>
                </tr>
                @endforeach
            </table>
            <?php echo $lists->links(); ?>
        </div>
    </div>
</div>
@stop