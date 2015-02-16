<?php

class IndexController extends BaseController {
    
    public function index() {
        // get news id, title and category
        $news = new News();
        $newsList = $news->where('is_active', '=', 1)->take(2)->orderBy('news_id', 'DESC')->get();
        
        return View::make('index.master');
    }

    public function news($id) {
        $id = (int)$id;
        $news = new News();
        $data = $news->find($id);
        //var_dump($data);exit();
        return View::make('index.news', $data);
    }
    
}
