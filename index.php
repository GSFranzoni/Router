<?php 

require_once('./Route.php');
require_once('./Router.php');
require_once('./Request.php');
require_once('./Response.php');
require_once('./Test.php');
require_once('./NotFound.php');

$router = new Router;

$router->get('/files/{id}', 'Test::file');
$router->get('/home', 'Test::home');

$router->run();

?>