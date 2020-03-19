<?php 

namespace Controller;

use Router\Response as Response;
use Router\Request as Request;

class NotFoundController {

    public static function run(Request &$request, Response &$response, $args) {
        $response->write(array('message' => 'Not found!'))->withStatus(200);
    }

}

?>