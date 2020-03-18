<?php 

class NotFound {
    public static function run($request, $response, $args) {
        $response->setBody(['status' => '404 - Not Found.']);
        print $response->withHeader('Content-Type', 'application/json')->withStatus(404)->getData();
    }
}

?>