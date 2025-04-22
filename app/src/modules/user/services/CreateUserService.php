<?php

namespace App\Modules\User\Services;

use App\Modules\User\Entities\User;
use App\Src\Modules\User\Repository\UserRepositoryDatabase;

class CreateUserService 
{
    private $userRepositoryDatabase;

    public function __construct(UserRepositoryDatabase $userRepositoryDatabase)
    {
        $this->userRepositoryDatabase = $userRepositoryDatabase;
    }

    public function execute(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];
        $name = $data['name'];

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

        $user = new User([
            'email' => $email,
            'password' => $hashedPassword,
            'name' => $name
        ]);
    }
}