<?php 

namespace Controller;

use Router\Response as Response;
use Router\Request as Request;

class TestController {

    public static function file(Request &$request, Response &$response, $args) {
        $response->withHeader('Content-Type', 'image/png')->write(file_get_contents(FILES_PATH. '/red-cross.png'));
    }

    public static function home(Request &$request, Response &$response, $args) {
        $response->withHeader('Content-Type', 'application/json')->withStatus(200)->write(array('message' => "Hello, ". $request->getQuery('name'). "!"));
    }

}

?>