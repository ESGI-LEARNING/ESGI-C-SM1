<?php

namespace Core\Middleware;

class BaseMiddleware
{
    public function redirect(string $path): void
    {
        header('Location: '.url($path));
        exit;
    }
}
