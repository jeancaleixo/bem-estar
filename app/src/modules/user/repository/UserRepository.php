<?php

namespace App\Src\Modules\User\Repository;

use App\Modules\User\Entities\User;
use App\Src\Interfaces\UserInteface;
use PDO;

class UserRepositoryDatabase
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findById(int $id): ?UserInteface
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['password']
        );
    }

    public function findByEmail(string $email): ?UserInteface
    {
        $stmt = $this->connection->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) {
            return null;
        }

        return new User($data);
    }

    public function save(UserInteface $user): void
    {
        if ($user->getId()) {
            $stmt = $this->connection->prepare(
                "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id"
            );
            $stmt->execute([
                'id' => $user->getId(),
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
            ]);
        } else {
            $stmt = $this->connection->prepare(
                "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)"
            );
            $stmt->execute([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
            $user->setId($this->connection->lastInsertId());
        }
    }

    public function delete(int $id): void
    {
        $stmt = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}