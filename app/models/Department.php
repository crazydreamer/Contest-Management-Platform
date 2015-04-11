<?php

class Department extends Eloquent {
    protected $table = "department";
    protected $primaryKey = "department_id";
    protected $fillable = array('name', 'is_active', 'level');
    public $timestamps = false;

}

