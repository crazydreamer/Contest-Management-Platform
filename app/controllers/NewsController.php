<?php

class NewsController extends BaseController {

    public function getIndex() {
        return $this->getList();
    }

    public function getList($keyword = NULL) {
        if ($keyword === NULL) {
            $lists = News::where('status', '!=', 2)->orderBy('news_id', 'desc')->paginate(10);
        } else {
            $lists = News::where('status', '!=', 2)->where('title', 'like', "%$keyword%")->orderBy('news_id', 'desc')->paginate(10);
        }
        foreach ($lists as $news) {
            $news->short_title = UtilsController::shortTitle($news->title, 55);
        }
        return View::make('admin.news.list')->with(
            array(
                'lists' => $lists,
            ));
    }

    public function getNew() {
        $cats = NewsCategory::where('status', '=', 1)->get();
        return View::make('admin.news.new')->with(array(
            'cats' => $cats,
            'maxNewsAttachSize' => Config::get('constant.uploadMaxSize'),
        ));
    }

    public function postNew() {

        $check = new AccountController();
        if ($check->checkPrivilege('>=', Config::get('constant.roles.contestAdmin'))){
            $news = new News;
            $data = array(
                'title' => Input::get('newsTitle'),
                'user_id' => Session::get('userId'),
                'cat_id' => (int) Input::get('categoryId'),
                'attachment_id' => Input::get('attachment') === ""? NULL : (int)Input::get('attachment'),
                'content' => Input::get('newsContent'),
            );
            if ($data['cat_id'] > 0) {
                $news->create($data);
                return UtilsController::redirect('发布成功，请进入新闻列表中进行审核', '/manage/news', 0);
            } else {
                return "请选择新闻对应分类！";
            }
        } else {
            return UtilsController::redirect('没有权限！', '/', 0);
        }

    }

    public function deleteIndex() {
        $id = Input::get('newsId');
        $news = News::find($id);
        $news->status = 2;
        $news->save();
    }

    public function postIndex() {
        $id = Input::get('newsId');
        $news = News::find($id);
        $news->status = 1;
        $news->save();
    }

    public function getEdit() {
        $id = Input::get('id');
        $cats = NewsCategory::where('status', '!=', 2)->get();
        $data = DB::table('news')->where('news_id', '=', $id)
                ->leftjoin('news_category', 'news.cat_id', '=', 'news_category.cat_id')
                ->select('news.*', 'news_category.cat_id', 'news_category.name')
                ->first();
        return View::make('admin.news.edit')->with(
                        array(
                            'cats' => $cats,
                            'data' => $data,
        ));
    }

    public function postEdit() {
        // FIX ME ：attachment edit no supported
        $news = News::find(Input::get('newsId'));
        $news->title = Input::get('newsTitle');
        $news->user_id = 1; //FIX ME ; add real author when user model finished.
        $news->cat_id = (int) Input::get('categoryId');
        $news->content = Input::get('newsContent');
        $news->update_time = date('Y-m-d H:i:s', time());
        $news->save();
        return $this->getIndex();
    }

    public function getCategory() {
        $cats = NewsCategory::where('status', '!=', 2)->paginate(10);
        return View::make('admin.news.category')->with(
                        array(
                            'cats' => $cats,
        ));
    }

    public function postCategory() {
        $newsCategory = new NewsCategory;
        $name = Input::get('name');
        $newsCategory->create(array('name' => $name));
        // FIX ME  未做错误处理
        return $this->getCategory();
    }

    public function deleteCategory() {
        $id = Input::get('catId');
        $cat = NewsCategory::find($id);
        $cat->status = 2;
        $cat->save();
    }

    public function postSearch() {
        // FIX ME:此处未做关键字长度限制
        $keyword = Input::get('keyword'); 
        return $this->getList($keyword);
    }
}
