<?php
require_once '../config/db.php';
require_once '../controllers/User.php';

header("Content-type: application/json; charset=UTF-8");

$controller = new UserController($pdo);

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'POST':
        $controller->create();
        break;
    case 'GET':
        if (isset($_GET['id'])) {
            $controller->getById($_GET['id']);
        } else {
            $controller->list();
        }
        break;
    case 'PUT':
        $controller->update();
        break;
    case 'DELETE':
        $controller->delete();
        break;
    default:
        http_response_code(405);
        echo json_encode(["message" => "Método não permitido"]);
        break;
}