<?php

namespace Core\Middleware;

class AuthMiddleware
{
    public function __invoke($request, $response, $next)
    {
        if (!isset($_SESSION['user_id'])) {
            return $response->withRedirect('/login');
        }

        $response = $next($request, $response);
        return $response;
    }
}