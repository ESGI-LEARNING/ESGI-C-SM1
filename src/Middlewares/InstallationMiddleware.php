<?php

namespace App\Middlewares;

use App\Exceptions\UnauthorizedException;

class InstallationMiddleware
{
    public function __invoke($request, $response, $next)
    {
        if (!isset($_SESSION['user'])) {
            throw new UnauthorizedException();
        }
        return $next($request, $response);
    }
}