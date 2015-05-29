<?php

class AccountController extends BaseController {

    public function getIndex() {
        return $this->getAdd();
    }

    private static function queryRole($userId) {
        $user = new User();
        $result = $user->where('user_id', $userId)->get(array('role'))->toArray();
        return $result[0]['role'];
    }

    private static function queryRealName($userId) {
        $user = new User();
        $result = $user->where('user_id', $userId)->get(array('realname'))->toArray();
        return $result[0]['realname'];
    }

    public function isLogin() {
        if (Session::has('userId')) {
            if (!Session::has('role')) {
                Session::put('role', $this->queryRole(Session::get('userId')));
            }
            if (!Session::has('realName')) {
                Session::put('realname', $this->queryRealName(Session::get('userId')));
            }
            return true;
        } else {
            return false;
        }
    }

    public function checkPrivilege($operator = "=", $privilege) {
        if ($this->isLogin()) {
            $currentUser = (int)Session::get('role');
            $privilege = (int)$privilege;
            switch($operator) {
                case '=' :
                    return $currentUser === $privilege ? true : false ;
                    break;
                case '>' :
                    return $currentUser > $privilege ? true : false ;
                    break;
                case '<' :
                    return $currentUser < $privilege ? true : false ;
                case '>=' :
                    return $currentUser >= $privilege ? true : false ;
                case '<=' :
                    return $currentUser <= $privilege ? true : false ;
                default:
                    return false;
            }
        } else {
            return false;
        }
    }

    public function getAdd() {
        $list = Department::getList();
        return View::make('admin.account.add')->with('list', $list);
    }

    public function postAdd() {
        // 创建账号需要竞赛管理员及以上权限
        if ($this->checkPrivilege('>=', Config::get('constant.roles.contestAdmin'))) {
            $curr_pri = Session::get('role');
            $input = array(
                'role' => (int)Input::get('role'),
                'realname' => Input::get('realName'),
                'phone' => Input::get('phone'),
                'department_id' => Input::get('departmentId'),
                'username' => Input::get('account'),
                'password' => md5(Input::get('password')),
            );

            // 检查是否跨权限创建新用户
            if ($curr_pri < $input['role']) {
                return UtilsController::redirect('只能创建同级及以下用户，不能创建上级用户，请检查当前账户权限！', '/manage/account', 1);
            } else {
                $res = User::create($input)->toArray();
                if ($res['user_id'] > 0) {
                    return UtilsController::redirect('用户添加成功！', '/manage/account', 0);
                } else {
                    return UtilsController::redirect('未知错误，请联系管理员！', '/manage/account', 0);
                }
            }
        } else {
            return UtilsController::redirect('没有权限执行该动作！', '/manage', 0);
        }
    }

}