<?php

namespace Core\Auth;

use App\Models\User;
use Core\Session\PHPSession;

class Authenticator implements AuthenticatorInterface
{

    public function __construct(
        private readonly PHPSession $session
    )
    {
    }

    public function login(User $user): void
    {
      $this->session->set('auth', $user->getId());
    }

    public function logout(): void
    {
        session_destroy();
        $this->session->delete('auth');
    }
}