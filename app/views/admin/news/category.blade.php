@extends('admin.news.master')

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="categoryList">
            <table class="table table-hover">
                <thead>
                <th>编号</th>
                <th>分类名称</th>
                <th>状态</th>
                <th>操作</th>
                </thead>
                @foreach ($lists as $list)
                <tr>
                    <th>{{ $list->cat_id }}</th>
                    <td>{{ '<a href="#">' . $list->name . '</a>' }}</td>
                    <td>{{ $list->is_active ? '已启用' : '未启用' }}</td>
                    <td>{{ $list->is_active ? '<a href="#">停用</a>' : '<a href="#">启用</a>' }}&nbsp; {{ '<a href="#">删除</a>' }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="container" id="addCategory">
            {{ Form::open(array('url' => 'http://dev.cc/manage/news/category', 'role' => 'form', 'class' => 'form-inline')); }}
            <div class="form-group">
                {{Form::label('cat_name', '添加新闻分类',  $attributes = array('class' => 'control-label'));}}

                {{Form::text('name', $value = null, $attributes = array(
                                 'id' => 'cat_name',
                                 'class' => 'form-control'));}}
            </div>
            {{Form::button('添加', $attributes = array(
                                 'type' => 'submit',
                                 'class' => 'btn btn-default' ));}}
            {{ Form::close(); }}
        </div>
    </div>
</div>
@stop