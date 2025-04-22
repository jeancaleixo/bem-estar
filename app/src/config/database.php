<?php
$host = 'localhost';
$dbname = 'seu_banco';
$user = 'usuario';
$password = 'senha';

try {
    $connection = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die("Erro ao conectar ao banco: " . $e->getMessage());
}

return $connection;