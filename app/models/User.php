<?php

class User extends Eloquent {
    protected $table = "user";
    protected $primaryKey = "user_id";
    protected $fillable = array('username', 'password', 'email', 'stu_id', 'department_id', 'role', 'last_login_ip');
    public $timestamps = false;
}
