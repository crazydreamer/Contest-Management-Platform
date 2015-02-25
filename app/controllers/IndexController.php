<?php

class IndexController extends BaseController {
    
    // 首页新闻公告列表显示新闻数量
    const INDEX_MODULE_NEWS_NUM = 7;

    private function getIndexNewsList() {
        $newsList = DB::table('news')->where('news.status', '=', 1)->take(self::INDEX_MODULE_NEWS_NUM)->orderBy('news_id', 'DESC')
            ->leftjoin('news_category', 'news.cat_id', '=', 'news_category.cat_id')
            ->select('news_id', 'title', 'news_category.cat_id', 'news_category.name')
            ->get();
        foreach ($newsList as $news) {
            $news->short_title = UtilsController::shortTitle($news->title, 40);
        }
        return $newsList;
    }
    
    public function index() {
        $newsList = $this->getIndexNewsList();
        return View::make('index.master')->with(array(
            'newsList' => $newsList,
        ));
    }

    public function news($id) {
        $id = (int)$id;
        $news = new News();
        $data = $news->find($id);
        return View::make('index.news', $data);
    }
    
}
