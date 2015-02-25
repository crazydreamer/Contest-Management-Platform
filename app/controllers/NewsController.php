<?php

class NewsController extends BaseController {

    public function getIndex() {
        $lists = News::where('status', '!=', 2)->get();
        foreach ($lists as $news) {
            $news->short_title = UtilsController::shortTitle($news->title, 55);
        }
        return View::make('admin.news.list')->with(
                        array(
                            'lists' => $lists,
        ));
    }

    public function getNew() {
        $lists = NewsCategory::where('is_active', '=', 1)->get();
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

    public function deleteIndex() {
        $id = Input::get('newsId');
        $news = News::find($id);
        $news->status = 2;
        $news->save();
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
