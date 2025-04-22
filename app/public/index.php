<?php
// public/index.php

// Carregar autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Obter a URI solicitada
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// Remover o prefixo '/bem-estar/' se presente
$path = str_replace('/bem-estar/', '', $path);

// Roteamento simples baseado no caminho
if ($path === 'user/create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../app/src/infra/http/user/UserController.php';
    $controller = new \App\Src\Infra\Http\User\UserController();
    $controller->create();
} else {
    // Página não encontrada
    header('HTTP/1.1 404 Not Found');
    echo json_encode(['error' => 'Endpoint não encontrado']);
}