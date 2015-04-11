<?php

class Contest extends Eloquent {
    protected $table = "contest";
    protected $primaryKey = "contest_id";
    protected $fillable = array('name', 'level', 'parent_id', 'description', 'host_department', 'start_time', 'end_time', 'status');
    public $timestamps = false;

}

