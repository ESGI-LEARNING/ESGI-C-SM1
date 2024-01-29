<?php

namespace App\Middlewares;

use Core\Auth\Auth;

class AuthMiddleware
{
    public function __invoke(): void
    {
        if (!Auth::check()) {
            $url = config('app.url') . '/login';
            header('Location: '. $url);
            exit();
        }
    }
}