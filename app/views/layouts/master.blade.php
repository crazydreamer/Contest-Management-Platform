<!doctype html>
<html lang="zh-CN">
    <head>
        <meta charset="UTF-8">
        <title>@section('title'){{{ $title or '学科竞赛管理平台' }}}@show</title>
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
            @section('banner')
            <div class="row-fluid banner">
                <div class="col-md-12">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="collapse navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="/">首页</a></li>
                                <li><a href="#">最新公告</a></li>
                                <li><a href="#">竞赛列表</a></li>
                                <li><a href="#">在线报名</a></li>
                                <li><a href="#">作品提交</a></li>
                                <li><a href="#">获奖作品</a></li>
                                <li><a href="#">优秀作品</a></li>
                                <li><a href="#">综合查询</a></li>
                            </ul>
                            <div class="nav navbar-nav navbar-right">
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="全站搜索">
                                    </div>
                                    <button type="submit" class="btn btn-default">搜索</button>
                                </form>
                            </div>
                        </div>
                </div>
                </nav>
            </div>
            @show

            @section('main')
            @show

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