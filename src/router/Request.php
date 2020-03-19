<?php 

namespace Router;

class Request {
    
    public static function getHeader($key) {
        return getallheaders()[$key];
    }

    public static function getBody(): string {
        return file_get_contents('php://input');
    }

    public static function getQuery(): array {
        return $_GET;
    }

    public static function getUri() {
        return $_SERVER['PATH_INFO'];
    }

    public static function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

}

?>