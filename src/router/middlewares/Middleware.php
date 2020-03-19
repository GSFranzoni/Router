<?php 

namespace Middleware;

use Router\Request;
use Router\Response;

abstract class Middleware {
    abstract function handle(Request &$request, Response &$response, $next);
}

?>