<?php 

define('CONTROLLER_PATH', realpath(dirname(__FILE__). '/../controller'));
define('ROUTER_PATH', realpath(dirname(__FILE__). '/../router'));
define('FILES_PATH', realpath(dirname(__FILE__). '/../files'));
define('MIDDLEWARE_PATH', realpath(dirname(__FILE__). '/../router/middlewares'));

require_once(realpath(CONTROLLER_PATH. '/NotFoundController.php'));
require_once(realpath(CONTROLLER_PATH. '/TestController.php'));

require_once(realpath(ROUTER_PATH. '/Request.php'));
require_once(realpath(ROUTER_PATH. '/Response.php'));
require_once(realpath(ROUTER_PATH. '/Route.php'));
require_once(realpath(ROUTER_PATH. '/Router.php'));

require_once(realpath(MIDDLEWARE_PATH. '/Middleware.php'));
require_once(realpath(MIDDLEWARE_PATH. '/AuthMiddleware.php'));

use Controller\TestController;
use Middleware\AuthMiddleware;
use Router\Router;

$router = new Router();

$router->get('/home', TestController::class. '::home')->add(AuthMiddleware::class);
$router->get('/files/{id}', TestController::class. '::file');

$router->run();

?>