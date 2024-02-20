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

    public static function getBody(): array
    {
        $body = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}
