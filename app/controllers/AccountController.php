<?php

class AccountController extends BaseController {

    public function getIndex() {
        return View::make('admin.account.master');
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

}