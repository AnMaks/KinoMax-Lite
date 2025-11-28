<?php

namespace App\Kernal\Auth;


class User
{
    public function __construct(
        private int $id,
        private string $email,
        private string $name,
        private string $password,
    ) {}

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}