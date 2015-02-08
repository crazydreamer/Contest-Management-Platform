<?php

class NewsCategory extends Eloquent {
    protected $table = "news_category";
    protected $primaryKey = "cat_id";
    protected $fillable = array('name');
    public $timestamps = false;
}

