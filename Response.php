<?php 

class Response {

    private $headers;
    private $body;
    private $status;
    private $message;

    public function __construct() {
        $this->headers = [
            'Content-Type' => 'application/json'
        ];
        $this->body = [];
        $this->status = 200;
        $this->message = 'Default';
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function withHeader($key, $value) {
        header("$key: $value");
        array_push($this->headers, [$key => $value]);
        return $this;
    }

    public function getBody() {
        return $this->getBody();
    }

    public function setBody($value) {
        $this->body = array_merge($this->body, $value);
    }

    public function getStatus(): int {
        return $this->status;
    } 

    public function getMessage(): string {
        return $this->message;
    }

    public function withStatus($status) {
        http_response_code($status);
        $this->status = $status;
        return $this;
    }

    public function getData() {
        switch($this->headers['Content-Type']) {
            case 'application/json':
                return json_encode($this->body);
            default:
                return $this->body;
        }
    }
}

?>