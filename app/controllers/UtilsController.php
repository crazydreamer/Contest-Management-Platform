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

    public static function redirect($msg, $dst, $countdown = 3) {
        return View::make('utils.redirect')->with(array(
            'countdown'     =>  $countdown,
            'message'       =>  $msg,
            'destination'   =>  $dst,
        ));
    }

    public static function getIp() {
            global $ip;
            if (getenv("HTTP_CLIENT_IP"))
                $ip = getenv("HTTP_CLIENT_IP");
            else if(getenv("HTTP_X_FORWARDED_FOR"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else if(getenv("REMOTE_ADDR"))
                $ip = getenv("REMOTE_ADDR");
            else $ip = "0.0.0.0";

            return $ip;
    }

}