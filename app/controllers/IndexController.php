<?php

    use Illuminate\Database\Eloquent\ModelNotFoundException;

    // 注册错误处理，此处在用户登陆校验失败时处理异常
    App::error(function(ModelNotFoundException $e)
    {
        return UtilsController::redirect('登录失败，用户名或密码错误', '/login', 0);
    });

class IndexController extends BaseController {

    private function getIndexNewsList() {
        $newsList = DB::table('news')->where('news.status', '=', 1)->take(Config::get('constant.INDEX_MODULE_NEWS_NUM'))->orderBy('news_id', 'DESC')
                ->leftjoin('news_category', 'news.cat_id', '=', 'news_category.cat_id')
                ->select('news_id', 'title', 'news_category.cat_id', 'news_category.name')
                ->get();
        foreach ($newsList as $news) {
            $news->short_title = UtilsController::shortTitle($news->title, 40);
        }
        return $newsList;
    }

    private function getIndexContestList() {
        $contestList = Contest::where('level', 2)->orderBy('end_time', 'desc')->take(Config::get('constant.INDEX_MODULE_CONTEST_NUM'))->get();
        foreach ($contestList as $contest) {
            $contest->name = UtilsController::shortTitle($contest->name, 35);
        }
        return $contestList;
    }

    public function index() {
        $newsList = $this->getIndexNewsList();
        $contestList = $this->getIndexContestList();
        return View::make('index.master')->with(array(
            'newsList'      =>  $newsList,
            'contestList'   =>  $contestList,
        ));
    }

    public function showSignup() {
        $departmentList = Department::where('is_active', 1)->where('level', 1)->get();
        return View::make('index.signup')->with(array(
            'departmentList' => $departmentList,
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
        DB::table('news')->where('news_id', $id)->increment('clicks', 1);
        return View::make('index.news', $news);
    }

    // 新闻中心
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

    // 竞赛列表
    public function contestCenter() {
        $contestList = Contest::where('status', '<', 3)->where('level', 2)->orderBy('end_time', 'desc')->paginate(15);
        return View::make('index.contestCenter', array(
            'list' => $contestList,
        ));
    }

    public function login() {
        $account = Input::get('username');
        $raw_pass = Input::get('password');

        if (strlen($account)&&strlen($raw_pass) != 0) {
            return $this->checkLogin($account, $raw_pass);
        } else {
            return UtilsController::redirect('用户名或密码不能为空!', '/login', 0);
        }
    }

    private function checkLogin($account, $raw_pass) {
        // 检测是否是站点管理员登陆
        $superUsers = Config::get('constant.superUsers');
        foreach ($superUsers as $su) {
            if ($account == $su) {
                return $this->adminLogin($account, $raw_pass);
            }
        }
        // 下面进入其他用户登陆检测

    }

    private function adminLogin($account, $raw_pass) {
        $password = md5($raw_pass.Config::get('constant.SUPERUSER_SALT'));
        $r = User::findOrFail(1);
        $r = User::where('username', $account)->where('password', $password)->take(1)->firstOrFail()->get();
        if (Config::get('constant.roles.siteAdmin') == $r[0]->role) {
            // 站点管理员登陆成功
            Session::put('userId', $r[0]->user_id);
            Session::put('role', $r[0]->role);
            Session::put('realName', $r[0]->realname);
            return UtilsController::redirect('登陆成功，即将进入管理后台', '/manage', 0);
        }
    }

    public function logout() {
        if (Session::has('userId')) {
            Session::flush();
            // 退出吼清空Session，跳转回网站首页
            return UtilsController::redirect('您已成功退出登录！', '/', 0);
        } else {
            return UtilsController::redirect('您尚未登陆！', '/', 0);
        }
    }

}
