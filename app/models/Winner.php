<?php

class Winner extends Eloquent {
    protected $table = "winner";
    protected $primaryKey = "id";
    protected $fillable = array('contest_id', 'name', 'list', 'user_id', 'update_time');
    public $timestamps = false;

}

