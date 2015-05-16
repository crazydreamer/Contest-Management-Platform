@extends('admin.news.master')

@section('title')
发布新闻
@stop

@section('javascript')
<script src="/plugins/ckeditor/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
            $('#file').change(function(){
                var file = this.files[0];
                var name = file.name;
                var size = file.size;
                var type = file.type;
                //validation Here

            });

            $('#buttonUpload').click(function(){
                var formData = new FormData($('#formAttachment')[0]);
                $.ajax({
                    url: '/upload',
                    type: 'POST',
                    xhr: function() {  // Custom XMLHttpRequest
                        var myXhr = $.ajaxSettings.xhr();
                        if(myXhr.upload){ // Check if upload property exists
                            myXhr.upload.addEventListener('progress',progressHandlingFunction, false); // For handling the progress of the upload
                        }
                        return myXhr;
                    },
                    //Ajax events
                    //beforeSend: beforeSendHandler,
                    success: function(result){
                        if (result.err_no == 0) {
                            $('#newsAttachment').attr("value", result.attach_id);
                            alert('上传成功！');
                        } else {
                            alert('上传失败，请检查错误原因：' + result.msg);
                        }
                    },
                    //error: errorHandler,
                    // Form data
                    data: formData,
                    //Options to tell jQuery not to process data or worry about content-type.
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });

        function progressHandlingFunction(e){
            if(e.lengthComputable){
                $('progress').attr({value:e.loaded,max:e.total});
            }
        }
    </script>
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
                <input type="text" id="newsAttachment" name="attachment" class="form-control hidden" value="">
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                {{Form::submit('发布', $attributes = array(
                                 'id' => 'submit',
                                 'class' => 'form-control btn btn-primary' ));}}
            </div>
        </div>
        {{ Form::close(); }}
        <div class="row attachment">
            <form action="/upload" id="formAttachment" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">附件上传</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="{{ $maxNewsAttachSize or 10000000 }}" />
                    <input type="file" name="file" id="file">
                    <p class="help-block">每个新闻只支持上传一个附件，如果要发布多个文件请压缩后放入压缩包中上传。</p>
                    <p class="help-block">支持的文件格式：rar，zip</p>
                    <progress></progress>
                </div>
                <button type="button" id="buttonUpload" class="btn btn-default">上传</button>
            </form>

        </div>
    </div>
</div>
@stop