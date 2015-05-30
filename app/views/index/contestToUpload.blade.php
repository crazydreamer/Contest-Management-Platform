@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="/css/index.css">
@stop

@section('title')
提交作品
@stop

@section('javascript')
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
                var formData = new FormData($('#formWorks')[0]);
                $.ajax({
                    url: '/upload/2',
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

        function showUploadForm(){
            if ($('#inputContest option:selected').val() > 0 ) {
                document.getElementById('uploadForm').classList.remove('hidden');
                $('#inputContestId').attr("value", $('#inputContest option:selected').val());
            }
        }
    </script>
@append

@section('main')
<div class="col-md-6 col-md-offset-3">
    <p class="center-block text-center"><strong>作品在线提交</strong></p>
    <div class="row attachment">
        <form id="formWorks" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <select onchange="showUploadForm()" name="contestId" id="inputContest" class="form-control">
                    <option>请选择竞赛</option>
                    @foreach($list as $contest)
                        <option value="{{$contest['contest_id']}}">{{$contest['name']}}</option>
                    @endforeach
                </select>
            </div>

            <div id="uploadForm" class="hidden">
                <div class="form-group">
                    <input type="hidden" name="MAX_FILE_SIZE" value="{{ $maxNewsAttachSize or 10000000 }}" />
                    <input type="text" class="hidden" name="contestId" id="inputContestId" value="">
                    <input type="file" name="file" id="file">
                    <p class="help-block">作品提交请将全部文件打包放入压缩包内，每个比赛只允许上传一个作品文件，多次上传将覆盖之前上传的作品。</p>
                    <p class="help-block">支持的文件格式：rar，zip</p>
                    <p class="help-block red">上传完成后请查看页面结果提示后离开页面。</p>
                </div>
                <button type="button" id="buttonUpload" class="btn btn-default">上传</button>
            </div>

        </form>
    </div>
</div>

@overwrite
