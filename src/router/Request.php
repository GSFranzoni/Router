<?php 

namespace Router;

class Request {
    
    public function getHeader($key) {
        return getallheaders()[$key];
    }

    public function getBody(): string {
        return file_get_contents('php://input');
    }

    public function getQueries(): array {
        return $_GET;
    }

    public function getQuery($key): string {
        return $_GET[$key];
    }

    public function getUri() {
        return $_SERVER['PATH_INFO'];
    }

    public function getMethod() {
        return $_SERVER['REQUEST_METHOD'];
    }

}

?>