<?php

namespace App\Helpers;

class ResponseCodes
{
    static private function response($code, $msg)
    {
        return response()->json(["error" => ["code" => $code, "message" => $msg]])->setStatusCode($code);
    }

    static public function r404($msg = "Not Found")
    {
        return static::response(404, $msg);
    }
    static public function r500($msg = "Internal Server Error")
    {
        return static::response(500, $msg);
    }
}
