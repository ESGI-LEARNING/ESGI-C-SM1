<?php

namespace Core\Router;

class Request
{
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function get(string $key): string
    {
        return $_GET[$key] ?? '';
    }

    public static function all(): array
    {
        return $_GET;
    }

    public static function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
