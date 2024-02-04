<?php

namespace Core\Router;

class Request
{
    public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public function get(string $key): string
    {
        return $_GET[$key] ?? '';
    }

    public function all(): array
    {
        return $_GET;
    }

    public function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function file(string $key): array
    {
        return $_FILES[$key];
    }
}
