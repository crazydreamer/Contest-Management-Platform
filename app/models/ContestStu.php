<?php

class ContestStu extends Eloquent {
    protected $table = "contest_stu";
    protected $primaryKey = "id";
    protected $fillable = array('user_id', 'contest_id', 'attachment_id');
    public $timestamps = false;

    public static function joinedList($userId) {
        return ContestStu::where('user_id', $userId)->get(array('contest_id'))->toArray();
    }

    public static function saveStuWorks($userId, $contestId, $attachmentId) {
        return ContestStu::where('user_id', $userId)->where('contest_id', $contestId)->update(array('attachment_id' => $attachmentId));

    }
}

