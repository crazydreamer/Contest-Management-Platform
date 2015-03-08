@extends('layouts.master')

@section('css')
@parent
<link rel="stylesheet" href="/css/news.css">
@stop

@section('main')
<div class="row-fluid">
    <div class="col-md-2">
        <div class="sidebar">
            <p id="sidebar_1">新闻分类</p>
            <hr />
            <div class="sideNav">
                @foreach ($category as $cat)
                <p><a href="/news/list/{{$cat->cat_id}}">{{$cat->name}}</a></p>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-1">
        <table class="table">
            @foreach ($list as $news)
            <tr><td>> <a href="/news/{{$news->news_id}}">{{$news->title}}</a></td><td>{{date('Y-m-d', strtotime($news->create_time))}}</td></tr>
            @endforeach
        </table>
        <?php echo $list->links(); ?>
    </div>
</div>
@stop