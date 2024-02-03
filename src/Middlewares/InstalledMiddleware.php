<?php

namespace App\Middlewares;


class InstalledMiddleware
{
    public function __invoke(): void
    {
        if(config('app.install') === 'false') {
            $url = config('app.url') . '/install';
            header('Location: '. $url);
        }
    }
}