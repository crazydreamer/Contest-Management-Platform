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

}