@extends('admin.news.master')

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="newsList">
            <table class="table table-hover">
                <thead>
                <th>编号</th>
                <th>新闻标题</th>
                <th>状态</th>
                <th>操作</th>
                </thead>
                @foreach ($lists as $list)
                <tr>
                    <th>{{ $list->news_id }}</th>
                    <td>{{ '<a href="/news/' . $list->news_id . '">' . $list->title . '</a>' }}</td>
                    <td>{{ $list->is_active ? '已发布' : '未发布' }}</td>
                    <td>{{ $list->is_active ? '&nbsp&nbsp' :'<a href="#">发布</a>' }}&nbsp; {{'<a href="#">修改</a>' . '&nbsp<a href="#">删除</a>' }}</td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="container" id="searchNews">
            {{ Form::open(array('url' => 'http://dev.cc/manage/news/category', 'role' => 'form', 'class' => 'form-inline')); }}
            <div class="form-group">
                {{Form::label('news_title', '搜索新闻',  $attributes = array('class' => 'control-label'));}}

                {{Form::text('title', $value = null, $attributes = array(
                                 'id' => 'news_title',
                                 'class' => 'form-control'));}}
            </div>
            {{Form::button('搜索', $attributes = array(
                                 'type' => 'submit',
                                 'class' => 'btn btn-default' ));}}
            {{ Form::close(); }}
        </div>
    </div>
</div>
@stop