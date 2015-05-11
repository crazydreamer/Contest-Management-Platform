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

    private function getIndexWinnerList() {
        $limit = (int)Config::get('constant.INDEX_MODULE_WINNERLIST_NUM');
        $contestList = Contest::where('awarded', 1)->where('status', '<', 3)->take($limit)->orderBy('end_time', 'desc')->get(array('contest_id', 'name'))->toArray();
        $buffer = "";
        foreach ($contestList as $contest) {
            $buffer .= $contest['name'] . "<br />";
            $data = Winner::where('contest_id', $contest['contest_id'])->get(array('name', 'list', 'sp'))->toArray();
            foreach ($data as $record) {
                $buffer .= $record['name'] . "<br />";
                $buffer .= str_replace($record['sp'], '<br />', $record['list']) . "<br />";
            }
        }
        return $buffer;
    }

    public function index() {
        $newsList = $this->getIndexNewsList();
        $contestList = $this->getIndexContestList();
        $winnerList = $this->getIndexWinnerList();
        return View::make('index.master')->with(array(
            'newsList'      =>  $newsList,
            'contestList'   =>  $contestList,
            'winnerList'    =>  $winnerList,
        ));
    }

    public function showSignUp() {
        $departmentList = Department::where('is_active', 1)->where('level', 1)->get();
        return View::make('index.signup')->with(array(
            'departmentList' => $departmentList,
        ));
    }

    private function signUpInvalid($msg = "输入有误，请检查！") {
        return UtilsController::redirect($msg, '/signup', 1);
    }

    public function signUp() {
        // empty check
        $input = Input::all();

        foreach ($input as $i) {
            if (strlen($i) == 0) {
                return $this->signUpInvalid("请将注册信息填写完整，不能留空！");
            }
        }
        if ($input['departmentId'] == "0") {
            return $this->signUpInvalid("请将注册信息填写完整，不能留空！");
        }

        // valid check starts

        // stu_id
        preg_match_all("/\d+/", $input['stuId'], $stuIdOut, PREG_PATTERN_ORDER);
        if (empty($stuIdOut[0])) {
            return $this->signUpInvalid("学号只能由数字组成，请检查!");
        }
        if (strlen($input['stuId']) > Config::get('constant.stuIdRules.maxLength') ||
            strlen($input['stuId']) < Config::get('constant.stuIdRules.minLength')) {
            return $this->signUpInvalid("学号长度有误，请检查！");
        }

        // realname
        preg_match_all("/[a-z0-9 \/!@#$%^&\*()]+/", $input['realName'], $realNameOut, PREG_PATTERN_ORDER);
        if (!empty($realNameOut[0])) {
            var_dump($realNameOut[0]);exit();
            return $this->signUpInvalid("姓名只能由中文字符组成，请检查");
        }
        if (strlen($input['realName']) > 60 ||
            strlen($input['realName']) < 6) {
            return $this->signUpInvalid("姓名长度不符，请使用真实姓名！");
        }

        // phone 此处只做了基本格式验证，只要是13/15/17/18开头11位数字均通过
        preg_match_all("/1[3578]\d{9}/", $input['phone'], $phoneOut, PREG_PATTERN_ORDER);
        if (empty($phoneOut[0])) {
            return $this->signUpInvalid("手机号码无效，请使用中国大陆有效手机号码！");
        }

        // password
        if (strlen($input['password']) < 6 || strlen($input['password']) > 16) {
            return $this->signUpInvalid("密码长度应在6-16位之间！");
        }

        // department_id FIX ME : 此处未验证学院id是否真实有效
        preg_match_all("/\d+/", $input['departmentId'], $departmentOut, PREG_PATTERN_ORDER);
        if (empty($departmentOut[0])) {
            return $this->signUpInvalid("学院信息非法!");
        }
        // valid check ends

        $data = array(
            'username'      => $input['stuId'],
            'password'      => md5($input['password']),
            'realname'      => $input['realName'],
            'phone'         => $input['phone'],
            'stu_id'        => $input['stuId'],
            'department_id' => $input['departmentId'],
            'role'          => 1, //目前暂时只提供学生注册
            'last_login_ip' => UtilsController::getIp(),
        );

        $user = new User();
        $result = $user->create($data)->toArray();

        if ($result['user_id']) {
            return UtilsController::redirect("注册成功,您现在可以登陆平台了！", '/login', 1);
        } else {
            return UtilsController::redirect("系统错误，请联系管理员！", '/signup', 1);
        }

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
        if (Session::has('userId')) {
            return UtilsController::redirect('您已登陆，如需退出登陆，请点<a href="/logout">这里</a>，3秒后页面将跳回<a href="/">首页</a>！', '/', 3);
        }

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
        $user = new User();
        $r = $user->where('username', $account)->where('password', md5($raw_pass))->take(1)->get(array(
            'user_id', 'role', 'realname'
        ))->toArray();
        if (!empty($r)) {
            Session::put('userId', $r[0]['user_id']);
            Session::put('role', $r[0]['role']);
            Session::put('realName', $r[0]['realname']);
            return UtilsController::redirect($r[0]['realname'] . ',欢迎登录！', '/', 0);
        } else {
            return UtilsController::redirect('用户名或密码错误！', '/login', 0);
        }
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
