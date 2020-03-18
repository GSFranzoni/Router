<?php 

class Router {

    private const ROUTE_PATTERN = "/(\/.+)+$/";
    private const PARAM_PATTERN = "/{[a-z]+}$/";
    private $routes = [];

    public function __construct() {

    }

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
            throw new Exception('A rota recebida não possui o padrão correto!');
        }
        array_push($this->routes, new Route($url, $callback, $method));
    }

    public function run() {
        $request = new Request();
        foreach ($this->routes as $route) {
            $uri_array = explode('/', $request->getUri());
            $route_array = explode('/', $route->getUrl());
            if(count($uri_array) == count($route_array) && $request->getMethod() == $route->getMethod()) {
                $valid = true;
                $args = [];
                for($i=0; $i<count($uri_array); $i++) {
                    if($uri_array[$i] <> $route_array[$i]) {
                        if(preg_match(self::PARAM_PATTERN, $route_array[$i]) == 1) {
                            $args = array_merge($args, array(trim($route_array[$i], "/{}/") => $uri_array[$i]));
                        }
                        else {
                            $valid = false;
                            break;
                        }
                    }
                }
                if($valid) {
                    $this->callMethod($route->getCallback(), $args);
                    return;
                }
            }
        }
        $this->callMethod('NotFound::run', []);
    }

    public function getArgs() {
        
    }

    private function callMethod($callback, $args) {
        call_user_func(
            $callback, 
            new Request(),
            new Response(),
            $args
        );
    }

}

?>