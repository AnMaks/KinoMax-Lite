<?php

namespace App\Kernal\Auth;

use App\Kernal\Auth\AuthInterface;
use App\Kernal\Config\ConfigInteface;
use App\Kernal\DataBase\DataBaseInteface;
use App\Kernal\Session\SessionInterface;
use App\Kernal\Auth\User;

class Auth implements AuthInterface
{
    public function __construct(
        private DataBaseInteface $database,
        private SessionInterface $session,
        private ConfigInteface $config,
    ) {}

    public function attempt(string $username, string $password): bool
    {
        $user = $this->database->first($this->table(), [$this->username() => $username,]);

        if (!$user) {
            return false;
        }

        if (! password_verify($password, $user[$this->password()])) {
            return false;
        }
        //if ($password !== $user[$this->password()]) return false;

        $this->session->set($this->session_field(), $user['id']);


        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->session_field());
    }

    public function check(): bool
    {
        return $this->session->has($this->session_field());
    }

    public function user(): ?User
    {
        if (! $this->check()) {
            return null;
        }

        $user = $this->database->first($this->table(), ['id' => $this->session->get($this->session_field()),]);
        if ($user) {
            return new User(
                $user['id'],
                $user[$this->username()],
                $user[$this->password()],
            );
        }

        return null;
    }

    public function username(): string
    {
        return $this->config->get('auth.username', 'email');
    }

    public function password(): string
    {
        return $this->config->get('auth.password', 'password');
    }

    public function table(): string
    {
        return $this->config->get('auth.table', 'users');
    }

    public function session_field(): string
    {
        return $this->config->get('auth.session_field', 'user_id');
    }
}