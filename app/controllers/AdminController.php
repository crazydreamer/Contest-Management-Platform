<?php

class AdminController extends BaseController {

    public function getDepartment() {
        return View::make('admin.config.department');
    }

}