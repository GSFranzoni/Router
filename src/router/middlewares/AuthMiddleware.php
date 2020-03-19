<?php 

namespace Middleware;

class AuthMiddleware extends Middleware {

    public function handle(&$request, &$response, $next) {
        $response->write(array('auth' => 'false!'));
        return $next(false);
    }

}

?>