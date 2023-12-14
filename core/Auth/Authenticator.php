<?php

namespace Core\Auth;

use App\Models\User;
use Core\Session\PHPSession;

class Authenticator extends PHPSession
{
    public function login(User $user): void
    {
        session_start();
        $this->set('user_id', $user->getId());
    }

    public function logout(): void
    {
        session_destroy();
        $this->delete('auth');
    }
}
