@extends('admin.contest.master')

@section('title')
    发布获奖名单
@stop

@section('javascript')
    <script>
        function showForm(num) {
            document.getElementById('setNum').classList.add('hidden');
            document.getElementById('buttonNext').classList.add('hidden');
            document.getElementById('buttonSubmit').classList.remove('hidden');
            document.getElementById('hint').classList.remove('hidden');

            var newAward = document.createElement("div");
            newAward.classList.add("form-group");
            newAward.classList.add("hidden");
            newAward.innerHTML = '<label for="inputCount" class="col-sm-3 control-label"></label>';
            newAward.innerHTML += '<div class="col-sm-9"><input type="text" class="form-control" id="inputCount" name="count" value='+num+'></div>';

            var oldNode = document.getElementById('listzone');
            oldNode.appendChild(newAward);

            for (var i=1;i<=num;i++)
            {
                var newAward = document.createElement("div");
                newAward.classList.add("form-group");
                newAward.innerHTML = '<label for="inputAward1" class="col-sm-3 control-label">请输入奖项名称</label>';
                newAward.innerHTML += '<div class="col-sm-9"><input type="text" class="form-control" id="inputAward'+i+'" name="award'+i+'"></div>';
                newAward.innerHTML += '<label for="inputList1" class="col-sm-3 control-label">请输入获奖名单，每行一人</label>';
                newAward.innerHTML += '<div class="col-sm-9"><textarea type="text" class="form-control" id="inputList'+i+'" name="list'+i+'" rows="10"></textarea></div>';

                var oldNode = document.getElementById('listzone');
                oldNode.appendChild(newAward);
            }
        }
    </script>
@append

@section('functionArea')
<div class="col-md-8 col-md-offset-1">
    <div class="functionArea text-center">
        <p>正在为“{{ $contestName }}”发布获奖名单</p>
        <p id="hint" class="red hidden">请按照奖项从高到低顺序填写</p>
        <br />
        <form class="form-horizontal" method="POST" action="/manage/contest/award">
            <div class="form-group hidden">
                <label for="contestId" class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="contestId" name="contestId" value="{{ $contestId }}">
                </div>
            </div>
            <div class="form-group" id="setNum">
                <label for="inputAwardNum" class="col-sm-3 control-label">请输入奖项数量</label>
                <div class="col-sm-9">
                    <input type="number" class="form-control" id="inputAwardNum" placeholder="">
                </div>
            </div>
            <div class="form-group" id="buttonNext">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="button" class="form-control" onclick="showForm(document.getElementById('inputAwardNum').value)">下一步</button>
                </div>
            </div>

            <div id="listzone">
            <div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" id="buttonSubmit" class="form-control hidden">发布</button>
                </div>
            </div>
        </form>
    </div>
</div>
@stop