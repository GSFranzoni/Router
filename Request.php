<?php 

class Request {
    
    private $uri;
    private $method;
    private $headers;
    private $body;
    private $query;

    public function __construct()
    {
        $this->uri = $_SERVER['PATH_INFO'];
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->headers = getallheaders();
        $this->body = file_get_contents('php://input');
        $this->query = $_GET;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function getHeader($key) {
        return $this->headers[$key];
    }

    public function getBody(): string {
        switch($this->headers['Content-Type']) {
            case 'application/json':
                return json_encode($this->body);
            default:
                return $this->body;
        }
    }

    public function getQuery(): array {
        return $this->query;
    }

    public function getUri() {
        return $this->uri;
    }

    public function getMethod() {
        return $this->method;
    }

}

?>