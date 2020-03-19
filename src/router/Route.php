<?php 

namespace Router;

class Route {

    private $url, $callback, $method;

    public function __construct($url, $callback, $method) {
        $this->url = $url; 
        $this->callback = $callback;
        $this->method = $method;
    }

    public function getUrl(): string {
        return $this->url;
    }

    public function getCallback(): string {
        return $this->callback;
    }

    public function getMethod(): string {
        return $this->method;
    }
}

?>