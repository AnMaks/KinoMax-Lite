<?php

namespace App\Kernal\Router;

class Route
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middleware,
    ) {}

    public static function get(string $uri, $action, array $middleware =[]): static // Создает гет запрос для роутера
    {
        return new static($uri,'GET',$action,$middleware);
    }

    public static function post(string $uri, $action, array $middleware =[]): static // Создает пост запрос для роутера
    {
        return new static($uri,'POST',$action, $middleware);
    }


    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getMiddleware(): array
    {
        return $this ->middleware;
    }

    public function hasMiddleware(): bool
    {
        return ! empty($this -> middleware);
    }
}