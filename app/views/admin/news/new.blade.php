@extends('admin.news.master')

@section('title')
发布新闻
@stop

@section('javascript')
<script src="/plugins/ckeditor/ckeditor.js"></script>
@stop

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea">
        {{ Form::open(array('url' => '/manage/news/new', 'role' => 'form', 'class' => 'form-inline', 'id'=>'new_post')) ;}}
        <div class="row">
            <div class="form-group">
                <label for="dropdownMenu1" class="sr-only"></label>
                <input type="hidden" id="cat_id" name="categoryId" value="">
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="false">
                        <span id="selectedCategory">选择分类</span>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="category">
                        @foreach ($cats as $cat)
                        <li role="presentation" value="{{ $cat->cat_id }}" onclick="document.getElementById('selectedCategory').innerHTML = '{{ $cat->name }}';document.getElementById('cat_id').setAttribute('value', {{ $cat->cat_id }});"><a role="menuitem">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <input class='form-control' name="newsTitle" id="title" type='text' placeholder="新闻标题">
            </div>
        </div>
        <div class="row">
            <textarea name="newsContent" id="newsEditor" rows="10" cols="80">
            </textarea>
            <script>
                        CKEDITOR.replace('newsEditor');
            </script>
        </div>
        <div class="row">
            <div class="form-group">
                {{Form::submit('发布', $attributes = array(
                                 'id' => 'submit',
                                 'class' => 'form-control btn btn-primary' ));}}
            </div>
        </div>
        {{ Form::close(); }}
    </div>
</div>
@stop