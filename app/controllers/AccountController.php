<?php

class AccountController extends BaseController {

    public function getIndex() {
        return View::make('admin.account.master');
    }

    private function createAccount(array $data, $role) {
        $user = new User();
        switch ($role) {
            case 1:

                break;
            default:
                return false;
        }
        return $user->create($data);
    }

}