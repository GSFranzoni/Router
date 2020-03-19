<?php 

namespace Router;

use Middleware\Middleware;
use Router\Request;
use Router\Response;

class Route {

    private $url, $callback, $method, $middlewares;

    public function __construct($url, $callback, $method) {
        $this->url = $url; 
        $this->callback = $callback;
        $this->method = $method;
        $this->middlewares = [];
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

    public function getRequest(): Request {
        return $this->request;
    }

    public function getResponse(): Response {
        return $this->response;
    }

    public function getMiddlewares(): Array {
        return $this->middlewares;
    }

    public function add($middleware) {
        array_push($this->middlewares, new $middleware);
        return $this;
    }
}

?>