<?php

class NewsController extends \BaseController {

    public function getIndex() {
        return View::make('admin.news.list');
    }
    
    public function getNew() {
        return View::make('admin.news.new');
    }
    
    public function getCategory() {
        $lists = NewsCategory::get();
        return View::make('admin.news.category')->with(
                array(
                    'lists' => $lists,
                ));
    }
    
    public function postCategory() {
        $newsCategory = new NewsCategory;
        $name = Input::get('name');
        $newsCategory->create(array('name' =>  $name));
        // FIX ME  未做错误处理
        return $this->getCategory();
    }
}
