<?php

namespace App\Helpers;

class ResponseHelper {

    public static function responseSuccess(array $data = array(), $msg = "", $json = true, $statusCode = 200) 
    {
        if ($json) {
            return response()->json(array('success' => true, 'msg' => $msg, 'data' => $data), $statusCode);
        } else {
            return ['success' => true, 'msg' => $msg, 'data' => $data];
        }
    }

    public static function responseError(array $data = array(), $msg = "", $json = true, $statusCode = 500) 
    {
        if ($json) {
            return response()->json(array('success' => false, 'msg' => $msg, 'data' => $data), $statusCode);
        } else {
            return ['success' => false, 'msg' => $msg, 'data' => $data];
        }
    }

}
