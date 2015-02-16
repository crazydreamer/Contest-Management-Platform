<?php

class NewsController extends \BaseController {

    public function getIndex() {
        $lists = News::get();
        return View::make('admin.news.list')->with(
                        array(
                            'lists' => $lists,
        ));
    }

    public function getNew() {
        $lists = NewsCategory::get();
        return View::make('admin.news.new')->with(
                        array(
                            'lists' => $lists,
        ));
    }

    public function postNew() {
        $news = new News;
        $data = array(
            'title' => Input::get('newsTitle'),
            'user_id' => 1, //FIX ME ; add real author when user model finished.
            'cat_id' => 1, //FIX ME : the same with above
            'content' => Input::get('newsContent'),
        );
        $news->create($data);
        return $this->getIndex();
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
        $newsCategory->create(array('name' => $name));
        // FIX ME  未做错误处理
        return $this->getCategory();
    }

}
