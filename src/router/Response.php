<?php 

namespace Router;

class Response {

    public $body;

    public function withHeader($key, $value) {
        header("$key: $value");
        return $this;
    }

    public function withStatus($status) {
        http_response_code($status);
        return $this;
    }

    public function write($data) {
        $this->body = $data;
        return $this;
    }

    public function getHeader($key) {
        return getallheaders()[$key];
    }

    public function send() {
        switch($this->getHeader('Content-Type')) {
            case 'application/json':
                print json_encode($this->body);
            break;
            default:
                print json_encode($this->body);
            break;
        }
    }
}

?>