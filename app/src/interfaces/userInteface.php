<?php

namespace App\Src\Interfaces;

interface UserInteface
{
    public function getId(): int;
    public function getName(): string;
    public function getEmail(): string;
    public function getPassword(): string;

    public function setId(int $id): void;
    public function setName(string $name): void;
    public function setEmail(string $email): void;
    public function setPassword(string $password): void;
}