<?php

class ContestStu extends Eloquent {
    protected $table = "contest_stu";
    protected $primaryKey = "id";
    protected $fillable = array('user_id', 'contest_id');
    public $timestamps = false;

}

