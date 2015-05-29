<?php

class Department extends Eloquent {
    protected $table = "department";
    protected $primaryKey = "department_id";
    protected $fillable = array('name', 'is_active', 'level');
    public $timestamps = false;

    // 返回院系列表，当前只有1级部门
    public static function getList() {
        return Department::where('is_active', 1)->where('level', 1)->get();
    }
}

