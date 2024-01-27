<?php

namespace Core\Router;

class Request
{
    public static function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getUrlParams(string $key): string
    {
        return $_GET[$key] ?? '';
    }

    public static function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
