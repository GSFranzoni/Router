<?php 

namespace Router;

class Response {

    public static function withHeader($key, $value) {
        header("$key: $value");
        return Response::class;
    }

    public static function withStatus($status) {
        http_response_code($status);
        return Response::class;
    }
}

?>