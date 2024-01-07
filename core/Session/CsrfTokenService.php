<?php

namespace Core\Session;

class CsrfTokenService extends PHPSession
{
    public function generateToken(): string
    {
        $token = bin2hex(random_bytes(32));
        $this->set('csrf_token', $token);

        return $token;
    }

    public function isValidCsrfToken(string $csrf): bool
    {
        $token = $this->get('csrf_token');

        return $token === $csrf;
    }
}
