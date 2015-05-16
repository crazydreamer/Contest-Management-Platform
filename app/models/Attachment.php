<?php

class Attachment extends Eloquent {
    protected $table = "attachment";
    protected $primaryKey = "attachment_id";
    protected $fillable = array('name', 'filename', 'type', 'user_id');
    public $timestamps = false;

}

