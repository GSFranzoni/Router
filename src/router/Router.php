<?php 

namespace Router;

use Controller\NotFoundController;
use Router\Request;
use Router\Route as Route;
use Router\Response;

class Router {

    private const ROUTE_PATTERN = "/(\/.+)+$/";
    private const PARAM_PATTERN = "/{[a-z]+}$/";
    private $NOT_FOUND_ROUTE;
    private $routes = [], $response, $request;

    public function __construct()
    {
        $this->response = new Response();
        $this->request = new Request();
        $this->NOT_FOUND_ROUTE = new Route('*', NotFoundController::class. '::run', 'any');
    }

    private function valid($url) {
        return preg_match(self::ROUTE_PATTERN, $url) == 1;
    }

    public function get($url, $callback) {
        return $this->register($url, $callback, 'GET');
    }

    public function post($url, $callback) {
        return $this->register($url, $callback, 'POST');
    }

    public function put($url, $callback) {
        return $this->register($url, $callback, 'PUT');
    }

    public function delete($url, $callback) {
        return $this->register($url, $callback, 'DELETE');
    }

    private function register($url, $callback, $method) {
        if(!$this->valid($url)) {
            throw new \Exception('A rota recebida não possui o padrão correto!');
        }
        $route = new Route($url, $callback, $method);
        array_push($this->routes, $route);
        return $route;
    }

    public function run() {
        foreach ($this->routes as $route) {
            $uri_array = explode('/', $this->request->getUri());
            $route_array = explode('/', $route->getUrl());
            if(count($uri_array) == count($route_array) && $this->request->getMethod() == $route->getMethod()) {
                $args = [];
                if($this->matches($uri_array, $route_array, $args)) {
                    return $this->callRoute($route, $args);
                }
            }
        }
        return $this->callRoute($this->NOT_FOUND_ROUTE, $args);
    }

    public function callRoute($route, $args) {
        if($this->executeMiddlewares($route)) {
            call_user_func_array($route->getCallback(), [&$this->request, &$this->response, $args]);
        }
        $this->response->send();
    }

    public function executeMiddlewares($route) {
        foreach ($route->getMiddlewares() as $middleware) {
            $continue = $middleware->handle($this->request, $this->response, function($next) {
                return $next;
            });
            if(!$continue) return false;
        }
        return true;
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
