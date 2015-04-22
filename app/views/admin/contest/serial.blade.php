@extends('admin.contest.master')

@section('title')
系列竞赛
@stop

@section('css')
@append

@section('javascript')
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        <div id="contestList">
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
                        <td></td>
                    </tr>
                @endforeach
            </table>
            <?php echo $lists->links(); ?>
        </div>
        <p class="red">创建新的系列竞赛</p> <!-- FIX ME 排版重新弄一下这里 -->
        <div class="row" id="newSerial">
            {{ Form::open(array('url' => '/manage/contest/new', 'role' => 'form', 'class' => 'form')); }}

            <div class="form-group">
                <label class="control-label" for="name">竞赛名称</label>
                <div class="controls">
                    <input type="text" class="form-control" id="name" name="name">
                    <p class="help-block">此处请输入系列竞赛的名称，不需要加入第X届，初赛、复赛等字眼</p>
                    <p class="help-block">例如：</p>
                    <p class="help-block">第八届<span class="red">全国大学生信息安全竞赛</span></p>
                    <p class="help-block">第八届“XX杯”<span class="red">全国大学生信息安全竞赛</span>复赛</p>
                    <p class="help-block">第八届<span class="red">全国大学生信息安全竞赛</span>校内赛复赛</p>
                    <p class="help-block">全国<span class="red">全国大学生信息安全竞赛</span>校内赛选拔赛</p>
                    <p class="help-block">等，其系列赛事名称应填写为 <strong><span class="red">全国大学生信息安全竞赛</span></strong></p>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label" for="name">竞赛描述</label>
                <div class="controls">
                    <textarea class="form-control" id="description" name="description"></textarea>
                    <p class="help-block">请输入竞赛简介，若没有可留空</p>
                </div>
            </div>

            <div class="form-group">
                <input class="form-control hidden" name="level" value="1" readonly>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control" value="创建竞赛">
            </div>
            {{ Form::close(); }}
        </div>
    </div>
</div>
@stop