<?php

class User extends Eloquent {
    protected $table = "user";
    protected $primaryKey = "user_id";
    protected $fillable = array('username', 'realname', 'password', 'phone', 'stu_id', 'department_id', 'role', 'last_login_ip');
    public $timestamps = false;
}
