<?php
// 存放各类工具函数

class UtilsController extends BaseController {

    const NEWS_ATTACHMENT   = 1;
    const STU_WORK          = 2;

    public static function shortTitle($name, $maxLength) {
        $len = strlen($name);
        $i = 0;
        $j = 0;
        $k = 0;
        while ($i < $maxLength && $j < $len) {
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

    public function upload($type = self::NEWS_ATTACHMENT) {

        $res = array();
        $data = array();

        $loginCheck = new AccountController();
        if (!$loginCheck->isLogin()) {
            $res['err_no'] = -1;
            $res['msg'] = 'please login!';
            return $res;
        }

        $file = head($_FILES);
        $res['err_no'] = $file['error'];
        $res['msg'] = 'upload failed';

        switch ($type) {
            case self::NEWS_ATTACHMENT:
                $uploadDir = Config::get('constant.newsAttachPath');
                $data['type'] = "news";
                break;
            case self::STU_WORK:
                $uploadDir = Config::get('constant.studentWorkPath');
                $data['type'] = "stu_work";
                break;
            default:
                break;
        }

        // 此处应修改文件名为随机名称
        $uploadFile = $uploadDir . md5(time() . Session::get('userId')) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        switch ($file['error']) {
            case UPLOAD_ERR_OK:
                $res['msg'] = 'success.';
                if (($file['size'] <= Config::get('constant.uploadMaxSize'))
                && ($file['size'] > 0)
                ) {
                    if (($file['type'] == 'application/x-zip-compressed')
                        || ($file['type'] == 'application/octet-stream')
                        || ($file['type'] == 'application/zip')
                    ) {
                        if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                            $attach = new Attachment();
                            $data['filename'] = basename($uploadFile);
                            $data['user_id'] = Session::get('userId');
                            $r = $attach->create($data)->toArray();
                            $res['attach_id'] = $r['attachment_id'];
                        } else {
                            $res['err_no'] = -1;
                            $res['msg'] = 'Internal Error: error when saving file to target folder';
                        }
                    } else {
                        $res['err_no'] = -1;
                        $res['msg'] = 'file type not supported!';
                    }
                } else {
                    $res['err_no'] = -1;
                    $res['msg'] = 'file size can not exceed ' . Config::get('constant.uploadMaxSize') . 'Byte and can not be empty either.';
                }
                break;
            case UPLOAD_ERR_INI_SIZE:
                $res['msg'] = 'Internal Error: file size exceeds limitation.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $res['msg'] = 'File Size too big!';
                break;
            case UPLOAD_ERR_PARTIAL:
                $res['msg'] = 'Upload incomplete, please try again.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $res['msg'] = 'No file uploaded,please select a specific file!';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $res['msg'] = 'Internal Error: no tmp dir.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $res['msg'] = 'Internal Error: failed to write file.';
                break;
            default:
                $res['err_no'] = -1;
                break;
        }

        return $res;
    }

    public function download($type, $filename) {
        switch ($type) {
            case "news":
                $fileDir = Config::get('constant.newsAttachPath');
                break;
            case "stu_work":
                $fileDir = Config::get('constant.studentWorkPath');
                break;
            default:
                return UtilsController::redirect('文件未找到！', '/', 0);
        }
        $file = $fileDir . basename($filename);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }

    public static function queryAttachFilename($id) {
        return head(Attachment::where('attachment_id', $id)->get(array('filename'))->toArray())['filename'];
    }

    public static function currentDatetime() {
        date_default_timezone_set("PRC");
        return date('Y-m-d H:i:s', time());
    }
}