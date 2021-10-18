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

    static public function r400($msg = "Bad Request")
    {
        return static::response(400, $msg);
    }
    static public function r401($msg = "Unauthorized")
    {
        return static::response(401, $msg);
    }
}
