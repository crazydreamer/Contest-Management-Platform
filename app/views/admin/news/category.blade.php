@extends('admin.news.master')

@section('javascript')
<script>
    function sendAction(action, id) {
        switch (action)
        {
            case "delete":
                if (confirm('是否要刪除文章文类？'))
                    $.ajax({
                        url: '/manage/news/category',
                        type: 'DELETE',
                        data: 'catId=' + id,
                        success: function () {
                            alert('分类删除成功！');
                            window.location.href = window.location.href;
                        }
                    });
                break;
            default:
        }
    }
</script>
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="categoryList">
            <table class="table table-hover text-center">
                <thead>
                <th>编号</th>
                <th>分类名称</th>
                <th>状态</th>
                <th>操作</th>
                </thead>
                @foreach ($cats as $cat)
                <tr class="{{$cat->status ? '' : 'warning'}}">
                    <th>{{ $cat->cat_id }}</th>
                    <td>{{ '<a href="#">' . $cat->name . '</a>' }}</td>
                    <td>{{ $cat->status ? '已启用' : '未启用' }}</td>
                    <td>{{ '<a onclick="sendAction(\'delete\', ' . $cat->cat_id . ')">删除</a>' }}</td>
                </tr>
                @endforeach
            </table>
            <?php echo $cats->links(); ?>
        </div>
        <div class="container" id="addCategory">
            {{ Form::open(array('url' => '/manage/news/category', 'role' => 'form', 'class' => 'form-inline')); }}
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