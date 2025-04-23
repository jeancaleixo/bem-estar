<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';

use App\Src\Infra\Http\User\UserController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Roteamento básico
if ($uri === '/bem-estar/user/create' && $method === 'POST') {
    $controller = new UserController();
    $controller->create();
    exit;
}

http_response_code(404);
echo json_encode(['success' => false, 'message' => 'Rota não encontrada']);