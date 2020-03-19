<?php 

namespace Router;

use Controller\NotFoundController;
use Router\Request as Request;

class Router {

    private const ROUTE_PATTERN = "/(\/.+)+$/";
    private const PARAM_PATTERN = "/{[a-z]+}$/";
    private $routes = [];

    private function valid($url) {
        return preg_match(self::ROUTE_PATTERN, $url) == 1;
    }

    public function get($url, $callback) {
        $this->register($url, $callback, 'GET');
    }

    public function post($url, $callback) {
        $this->register($url, $callback, 'POST');
    }

    public function put($url, $callback) {
        $this->register($url, $callback, 'PUT');
    }

    public function delete($url, $callback) {
        $this->register($url, $callback, 'DELETE');
    }

    private function register($url, $callback, $method) {
        if(!$this->valid($url)) {
            throw new \Exception('A rota recebida não possui o padrão correto!');
        }
        array_push($this->routes, new Route($url, $callback, $method));
    }

    public function run() {
        foreach ($this->routes as $route) {
            $uri_array = explode('/', Request::getUri());
            $route_array = explode('/', $route->getUrl());
            if(count($uri_array) == count($route_array) && Request::getMethod() == $route->getMethod()) {
                $args = [];
                if($this->matches($uri_array, $route_array, $args)) {
                    return call_user_func($route->getCallback(), $args);
                }
            }
        }
        call_user_func(NotFoundController::class. '::run', []);
    }

    public function matches($uri_array, $route_array, &$args) {
        for($i=0; $i<count($uri_array); $i++) {
            if($uri_array[$i] <> $route_array[$i]) {
                if(preg_match(self::PARAM_PATTERN, $route_array[$i]) == 1) {
                    $args = array_merge($args, array(trim($route_array[$i], "/{}/") => $uri_array[$i]));
                }
                else return false;
            }
        }
        return true;
    }

}

?>