<?php

namespace App\Modules\User\Services;

use App\Modules\User\Entities\User;
use App\Src\Modules\User\Repository\UserRepositoryDatabase;

class CreateUserService
{
    private UserRepositoryDatabase $userRepositoryDatabase;

    public function __construct(UserRepositoryDatabase $userRepositoryDatabase)
    {
        $this->userRepositoryDatabase = $userRepositoryDatabase;
    }

    public function execute(array $data): User
    {

        $existingUser = $this->userRepositoryDatabase->findByEmail($data['email']);
        if ($existingUser) {
            throw new \Exception("Usuário com este email já existe");
        }

        $email = $data['email'];
        $password = $data['password'];
        $name = $data['name'];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $user = new User([
            null,
            'email' => $email,
            'password' => $hashedPassword,
            'name' => $name
        ]);

        $this->userRepositoryDatabase->save($user);

        return $user;
    }
}
