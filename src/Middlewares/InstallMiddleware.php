<?php

namespace App\Middlewares;

class InstallMiddleware
{
    public function __invoke(): void
    {
        if (config('app.install') === '1') {
            $url = config('app.url').'/login';
            header('Location: '.$url);
        }
    }
}
