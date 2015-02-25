<?php
// 存放各类工具函数

class UtilsController extends BaseController {

    public static function shortTitle($name, $maxlength) {
        $len = strlen($name);
        $i = 0;
        $j = 0;
        $k = 0;
        while ($i < $maxlength && $j < $len) {
            $temp = mb_substr($name, $k, 1, 'utf8');
            if (strlen($temp) == 1) {
                $i += 1;
            } else {
                $i += 2;
            }
            $j += strlen($temp);
            $k++;
        }
        if ($j < $len) {
            return substr($name, 0, $j) . "...";
        }
        return substr($name, 0, $j);
    }

}
