<?php
require_once '../config/db.php';
require_once '../controllers/User.php';
require_once '../Router.php';

header("Content-type: application/json; charset=UTF-8");

$router = new Router();
$controller = new UserController($pdo);

$router->add('GET', '/users', [$controller, 'list']);
$router->add('GET', '/users/{id}', [$controller, 'getById']);
$router->add('POST', '/users', [$controller, 'create']);
$router->add('DELETE', '/users/{id}', [$controller, 'delete']);
$router->add('PUT', '/users/{id}', [$controller, 'update']);

$requestedPath = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$pathItems = explode("/", $requestedPath);
$requestedPath = "/" . $pathItems[3] . ($pathItems[4] ? "/" . $pathItems[4] : "");

$router->dispatch($requestedPath);
