<?php 

namespace Controller;

use Router\Response as Response;

class NotFoundController {

    public static function run($args) {
        Response::withHeader('Content-Type', 'application/json')::withStatus(404);
        print 'NOT FOUND!';
    }

}

?>