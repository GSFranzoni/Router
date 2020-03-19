<?php 

namespace Middleware;

abstract class Middleware {
    abstract function handle(&$request, &$response, $next);
}

?>