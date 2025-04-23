<?php

namespace App\Src\Config;

use PDO;
use PDOException;

class Database
{
    function Connection()
    {
        $host = 'localhost';
        $dbname = 'estar';
        $user = 'root';
        $password = 'detonado222';

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
    }
}