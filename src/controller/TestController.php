<?php 

namespace Controller;

use Router\Response;

class TestController {

    public static function file(&$request, &$response, $args) {
        $response->withHeader('Content-Type', 'image/png')->write(file_get_contents(FILES_PATH. '/red-cross.png'));
    }

    public static function home(&$request, &$response, $args) {
        $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

}

?>