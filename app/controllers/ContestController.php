<?php

class ContestController extends BaseController {

    public function getIndex() {
        return $this->getNew();
    }

    public function getList() {
        $lists = Contest::where('level', 2)->paginate(15);
        return View::make('admin.contest.list')->with(array(
            'lists' => $lists,
        ));
    }

    public function getNew() {
        $serialContests = Contest::where('level', 1)->get();
        $departmentList = Department::where('is_active', 1)->where('level', 1)->get();
        return View::make('admin.contest.new')->with(array(
            'parentContests' => $serialContests,
            'departmentList' => $departmentList,
        ));
    }

    public function postNew() {
        $type = (int)Input::get('level');

        $data = array(
            'name'              =>  Input::get('name'),
            'level'             =>  $type,
            'description'       =>  Input::get('description'),
        );

        // FIX ME : 输入数据未进行有效性检验
        $Contest = new Contest();
        switch($type){
            case 1:
                $data['status'] = 1;
                $Contest->create($data);
                return UtilsController::redirect('创建成功！', '/manage/contest/serial', 0);
                break;
            case 2:
                $data['status']             =   -1; // 单项竞赛发布前是否需要审核待定。
                $data['host_department']    =  Input::get('host');
                $data['start_time']         =  Input::get('start_time');
                $data['end_time']           =  Input::get('end_time');
                $data['attend_deadline']    =  Input::get('attend_deadline') === "" ? NULL : Input::get('attend_deadline');
                $data['with_works']         =  (int)Input::get('withWorks') === 1 ? 1 : 0  ;
                $data['works_deadline']         =  $data['with_works'] ? Input::get('works_deadline') : NULL;
                $Contest->create($data);
                return UtilsController::redirect('创建成功！', '/manage/contest/list', 0);
                break;
            default:
                return UtilsController::redirect('未知竞赛类型！', '/manage/contest/new', 0);
        }
    }

    public function getSerial() {
        $lists = Contest::where('level', 1)->paginate(10);
        return View::make('admin.contest.serial')->with(array(
            'lists' => $lists,
        ));
    }

    public function getWinners() {
        $lists = Contest::where('level', 2)->paginate(15);
        return View::make('admin.contest.awardList')->with(array(
            'lists' => $lists,
        ));
    }

    public function getAward($id) {
        $contestId = intval($id);
        if ($id <= 0) {
            return UtilsController::redirect('竞赛不存在！', '/manage/contest/winners', 1);
        }
        // 检查竞赛状态
        $check = Contest::where('contest_id', $contestId)->get(array('awarded'))->take(1)->toArray();
        if ($check[0]['awarded']) {
            // 已发布获奖名单，进入修改
        } else {
            // 发布新的获奖名单
            $contest = Contest::where('contest_id', $contestId)->get(array('name'))->toArray();
            $contestName = $contest[0]['name'];
            return View::make('admin.contest.award')->with(array(
                'contestId'     =>  $contestId,
                'contestName'   =>  $contestName,
            ));
        }
    }

    public function postAward() {
        $separator = "#SP#";
        // FIX ME : 此处没有对输入进行校验
        $input = Input::get();
        $contest_id = (int)$input['contestId'];
        $count = (int)$input['count'];
        $winner = new Winner();
        for($i = 1 ; $i <= $count ; $i++) {
            $data = array();
            $award = $input['award'.$i];
            $list = ltrim(rtrim($input['list'.$i]));
            $list = str_replace("\r\n", $separator, $list);
            $data = array(
                'contest_id'    =>  $contest_id,
                'name'          =>  $award,
                'list'          =>  $list,
                'sp'            =>  $separator,
                'user_id'       =>  Session::get('userId')
            );
            $winner->create($data);
        }
        $contest = Contest::where('contest_id', $contest_id)->update(array('awarded' => 1));
        return UtilsController::redirect('发布成功！', '/manage/contest/winners', 0);
    }

    public function getAttendee($contestId = NUll) {
        if ($contestId === NULl) {
            $lists = Contest::where('level', 2)->paginate(15);
            return View::make('admin.contest.attendee')->with(array(
                'lists' => $lists,
            ));
        } else {
            $contestId = (int)$contestId;
            $list = DB::table('user')
                ->join('contest_stu', function($join) use ($contestId)
                {
                    $join->on('user.user_id', '=', 'contest_stu.user_id')
                        ->where('contest_stu.contest_id', '=', $contestId);
                })->select(array('user.user_id', 'user.realname', 'user.stu_id', 'contest_stu.create_time'))
                ->paginate(20);
            return View::make('admin.contest.attendeeDetail')->with('list', $list);
        }

    }

    // 显示当前可报名参赛竞赛列表
    public function listToJoin() {
        // 获取当前可以报名的竞赛列表
        $contestList = Contest::where('attend_deadline', '>', date('Y-m-d H:i:s', time()))->get(array('name', 'contest_id', 'attend_deadline'));
        return View::make('index.joinContest')->with('contestList', $contestList);
    }

    public function join(){
        $user = new AccountController();
        if (Input::get('contestId') <= 0) {
            return '请选择竞赛！';
        }
        if ($user->checkPrivilege('=', 1)) {
            if (Contest::joinAvail(Input::get('contestId'))) {
                $joinAlready = ContestStu::where('user_id', Session::get('userId'))
                    ->where('contest_id', Input::get('contestId'))->get()->toArray();
                if (empty($joinAlready)) {
                    $data = array(
                        'user_id' => Session::get('userId'),
                        'contest_id' => Input::get('contestId'),
                    );
                    $r = ContestStu::create($data)->toArray();
                    if ($r['id'] > 0) {
                        return '报名成功！';
                    } else {
                        return '系统内部错误，请联系管理员！';
                    }
                } else {
                    return '您已报名过本竞赛,不能重复报名！';
                }
            } else {
                return '该竞赛当前不可报名，请检查选择！';
            }
        } else {
            return '竞赛只允许学生参赛，请使用学生账号登陆后重试';
        }
    }

    public function contestToUpload() {
        $user = new AccountController();
        if ($user->checkPrivilege('=', 1)) {
            $joinedList = ContestStu::joinedList(Session::get('userId'));
            if (!empty($joinedList)) {
                $joinedList = array_pluck($joinedList, 'contest_id');
                $list = Contest::where('with_works', 1)->where('works_deadline', '>' , UtilsController::currentDatetime())->get()->toArray();
                return View::make('index.contestToUpload')->with(array(
                    'list' => $list,
                    'maxNewsAttachSize' => Config::get('constant.uploadMaxSize'),
                    ));
            } else {
                return UtilsController::redirect('当前没有可提交作品的竞赛！！', '/', 1);
            }
        } else {
            return UtilsController::redirect('您当前账号身份不是学生，请使用学生账号登录后重试！', '/', 1);
        }
    }
}