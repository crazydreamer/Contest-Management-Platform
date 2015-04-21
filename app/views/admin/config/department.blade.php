@extends('admin.config.master')

@section('title')
    院系维护
@stop

@section('javascript')
    <script>
        function sendAction(action, id) {
            switch (action)
            {
                case "delete":
                    if (confirm('删除部门可能会影响其下属二级部门，是否继续？'))
                        $.ajax({
                            url: '/manage/config/department',
                            type: 'DELETE',
                            data: 'departmentId=' + id,
                            success: function () {
                                alert('部门已删除！');
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
        <p class="lead">本列表所显示部门为全部一级部门，包含各院系以及校级部门。如需对二级部门进行维护，请进入对应一级部门内执行操作。</p>
        <div id="addDepartment">
            {{ Form::open(array('url' => '/manage/config/department', 'role' => 'form', 'class' => 'form-inline')); }}
            <div class="form-group">
                {{Form::label('department_name', '添加一级部门',  $attributes = array('class' => 'control-label'));}}
                {{Form::text('name', $value = null, $attributes = array(
                                 'id' => 'department_name',
                                 'class' => 'form-control'));}}
                <input class="form-control" name="level" value="1" style="display: none">
            </div>
            {{Form::button('添加', $attributes = array(
                                 'type' => 'submit',
                                 'class' => 'btn btn-default' ));}}
            {{ Form::close(); }}
        </div>
        <table class="table table-condensed text-center">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>名称</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($list as $department)
                <tr>
                <td>{{$department->department_id}}</td>
                <td>{{$department->name}}</td>
                <td>{{'<a onclick="sendAction(\'delete\', ' . $department->department_id . ')">删除</a>'}}</td>
                </tr>
            @endforeach
            <tbody>
        </table>
        <?php echo $list->links(); ?>
    </div>
</div>
@stop