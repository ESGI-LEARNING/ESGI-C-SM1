<?php

namespace Core\Middleware;

use JetBrains\PhpStorm\NoReturn;

class BaseMiddleware
{
    public function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit() ;
    }
}
