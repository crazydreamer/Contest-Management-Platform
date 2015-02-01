<?php

class NewsController extends \BaseController {

    public function getIndex() {
        return View::make('admin.news.list');
    }
    
    public function getNew() {
        return View::make('admin.news.new');
    }
}
