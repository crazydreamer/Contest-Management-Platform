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

}