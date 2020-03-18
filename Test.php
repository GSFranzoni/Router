<?php 

class Test {

    public static function file($request, $response, $args) {
        $response->withHeader('Content-Type', 'application/pdf');
        readfile('./1b1c77224a1878af.pdf');
    }

    public static function home($request, $response, $args) {
        $response->setBody(array('name' => 'Gui'));
        print $response->withHeader('Content-Type', 'application/json')->withStatus(200)->getData();
    }

}

?>