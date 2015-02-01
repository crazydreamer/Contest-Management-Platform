@extends('admin.news.master')

@section('javascript')
<script src="//cdn.ckeditor.com/4.4.6/standard/ckeditor.js"></script>
@stop

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        {{ Form::open(array('url' => 'foo/bar', 'name' => 'test', 'role' => 'form', 'class' => 'form-horizontal')) ;}}
        <div class='form-group' >
            <div class="col-md-3">
                <div class="dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        新闻分类
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="newPostCategory">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">测试分类1</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">测试分类2</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <input class='form-control' id="title" type='text' placeholder="新闻标题">
            </div>

        </div>

        <textarea name="newsEditor" id="newsEditor" rows="10" cols="80">
        </textarea>
        <script>
CKEDITOR.replace('newsEditor');
        </script>
        <div class="form-group">
            <div class='col-md-12'>
                {{Form::submit('发布', $attributes = array(
                                 'id' => 'submit',
                                 'class' => 'form-control btn btn-primary' ));}}
            </div>
        </div>
        {{ Form::close(); }}
    </div>
</div>
@stop