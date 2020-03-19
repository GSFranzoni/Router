<?php 

namespace Middleware;

use Router\Request;
use Router\Response;

class AuthMiddleware extends Middleware {

    public function handle(Request &$request, Response &$response, $next) {
        $response->withHeader('Content-Type', 'application/json')->write(array('auth' => 'false!'))->withStatus(404);
        return $next(true);
    }

}

?>