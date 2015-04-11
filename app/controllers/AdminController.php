<?php

class AdminController extends BaseController {

    public function getDepartment() {
        $departmentList = Department::where('level', 1)->where('is_active', 1)->paginate(15);
        return View::make('admin.config.department')->with('list', $departmentList);
    }

    public function postDepartment()
    {
        $level = Input::get('level');
        switch ($level) {
            case 1:
                $department = new Department();
                $name = Input::get('name');
                $department->create(array(
                    'name' => $name,
                    'level' => 1,
                    'is_active' => 1,
                ));
                return $this->getDepartment();
                break;
            case 2:
                break;
            default:

        }
    }

    public function deleteDepartment() {
        $id = Input::get('departmentId');
        $cat = Department::find($id);
        $cat->is_active = 0;
        $cat->save();
    }
}