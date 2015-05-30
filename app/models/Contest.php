<?php

class Contest extends Eloquent {
    protected $table = "contest";
    protected $primaryKey = "contest_id";
    protected $fillable = array('name', 'level', 'parent_id', 'description', 'host_department', 'start_time', 'end_time', 'status', 'attend_deadline', 'with_works', 'works_deadline');
    public $timestamps = false;

    // 检查竞赛是否可以报名
    public static function joinAvail($contestId) {
        $res = Contest::where('contest_id', $contestId)->get(array('attend_deadline'))->toArray();
        if (!empty($res)) {
            $now = UtilsController::currentDatetime();
            // 判断当前时间是否早于结束时间
            if ($now < $res) {
                return true;
            }
        }
        return false;
    }

    public static function uploadAvail($contestId) {

        if (is_array($contestId)) {
            return Contest::whereIn('contest_id', $contestId)->get(array('contest_id', 'with_works', 'works_deadline'))->toArray();
        } elseif (is_integer($contestId)) {
            return Contest::where('contest_id', $contestId)->get(array('contest_id', 'with_works', 'works_deadline'))->toArray();
        } else {
            return NULL;
        }

    }
}

