<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>@section('title'){{{ $title or '学科竞赛管理平台' }}}@show</title>
    <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        var i = {{{$countdown or '3'}}};
        var intervalid;
        intervalid = setInterval("showCountdown()", 1000);
        function showCountdown() {
            if (i == 0) {
                window.location.href = "{{$destination}}";
                clearInterval(intervalid);
            }
            document.getElementById("countdown").innerHTML = i;
            i--;
        }
    </script>
</head>
<body>
{{$message}} <span id="countdown" hidden></span>
</body>
</html>