@extends('admin.news.master')

@section('javascript')
<script>
    function deleteNews(id) {
        $.ajax({
            url: '/manage/news',
            type: 'DELETE',
            data: 'newsId=' + id,
            success: function () {
                alert('文章刪除成功！');
                location.reload(); 
            }
        });
    }
</script>
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="newsList">
            <table class="table table-hover text-center">
                <thead>
                <th>id</th>
                <th>新闻标题</th>
                <th>状态</th>
                <th>操作</th>
                </thead>
                @foreach ($lists as $list)
                <tr class="{{$list->status ? '' : 'warning'}}">
                    <th>{{ $list->news_id }}</th>
                    <td>{{ '<a href="/news/' . $list->news_id . '">' . $list->short_title . '</a>' }}</td>
                    <td>{{ $list->status ? '已发布' : '未发布' }}</td>
                    <td>{{ $list->status ? '&nbsp&nbsp' :'<a href="#">发布</a>' }}&nbsp; {{'<a href="#">修改</a>' . '&nbsp<a href="#" onclick="deleteNews(' . $list->news_id . ')">删除</a>' }}</td>
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