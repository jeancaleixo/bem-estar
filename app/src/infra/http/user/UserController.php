<?php

namespace App\Src\Infra\Http\User; // ✅ Correto!

use App\Modules\User\Services\CreateUserService as ServicesCreateUserService;
use App\Src\Modules\User\Services\CreateUserService;
use App\Src\Config\Database;
use App\Src\Modules\User\Repository\UserRepositoryDatabase;
use Exception;

class UserController
{
    public function create()
    {
        header('Content-Type: application/json');

        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            if (!$data) {
                throw new Exception('Dados JSON inválidos');
            }

            if (empty($data['email']) || empty($data['password']) || empty($data['name'])) {
                throw new Exception('Email, Senha e Nome são obrigatórios');
            }

            $database = new Database();
            $pdo = $database->Connection();

            $repositoryDatabase = new UserRepositoryDatabase($pdo);
            $createUserService = new ServicesCreateUserService($repositoryDatabase);

            $user = $createUserService->execute($data);

            echo json_encode([
                'success' => true,
                'message' => 'Usuário criado com sucesso',
                'user' => [
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                    'email' => $user->getEmail()
                ]
            ]);
        } catch (Exception $e) {
            // Retornar resposta de erro
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}