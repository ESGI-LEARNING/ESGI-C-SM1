<?php

namespace Core\Router;

class Request
{
    static public function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    static public function getUrlParams(string $key): string
    {
        return $_GET[$key] ?? '';
    }

    static public function getUrl(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}