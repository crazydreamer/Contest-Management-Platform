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
        $id = (int) $id;
        $data = DB::table('news')->where('news_id', '=', $id)
                ->leftjoin('news_category', 'news.cat_id', '=', 'news_category.cat_id')
                ->select('news.*', 'news_category.cat_id', 'news_category.name')
                ->first();
        $news = array();
        foreach ($data as $k => $v) {
            $news[$k] = $v;
        }
        return View::make('index.news', $news);
    }

    public function newsCenter($cat_id = NULL) {
        $cats = NewsCategory::where('status', '=', 1)->get();
        //  如果传入 cat_id 参数，则 where cat_id = id,否则选取全部分类，即 cat_id > 0
        $newsList = News::where('status', '=', 1)->where('cat_id', ($cat_id === NULL) ? '>' : '=', ($cat_id === NULL) ? 0 : (int) $cat_id)
                        ->orderBy('news_id', 'desc')->paginate(15);
        return View::make('index.newsCenter', array(
                    'category' => $cats,
                    'list' => $newsList,
        ));
    }

}
