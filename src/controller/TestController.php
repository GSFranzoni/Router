<?php 

namespace Controller;

use Router\Response;

class TestController {

    public static function file(&$request, &$response, $args) {
        Response::withHeader('Content-Type', 'application/pdf');
        readfile(FILES_PATH. '/1b1c77224a1878af.pdf');
    }

    public static function home(&$request, &$response, $args) {
        Response::withHeader('Content-Type', 'application/json')::withStatus(200);
        return json_encode(array('id' => 1));
    }

}

?>