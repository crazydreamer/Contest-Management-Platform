<!doctype html>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <title>{{{ $title or '学科竞赛管理平台' }}}</title>
        <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        @section('javascript')
        @show
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="/css/common.css">
        @section('css')
        @show
    </head>
    <body>
        <div class="container">
            <div class="row-fluid">
                <div class="col-md-12">
                    <img src="/img/banner_index.jpg" class="img-rounded" width="100%">
                </div>
            </div>
            @yield('banner')
            
            @yield('main')
           
            @section('footer')
            <div class="row-fluid text-center">
                <div class="col-md-8 col-md-offset-2 footer">
                    <p>
                        <a href="/" target="_blank">网站首页</a> |
                        <a href="#" target="_blank">联系我们</a> |
                        <a href="http://www.uestc.edu.cn" target="_blank">电子科技大学</a>
                    </p>
                    <p>
                        © 2014 - {{{ date('Y',time())}}} <a href="http://www.ccse.uestc.edu.cn" target="_blank">电子科技大学计算机科学与工程学院</a>
                    </p>
                </div>
            </div>
            @show
        </div>
    </body>
</html>