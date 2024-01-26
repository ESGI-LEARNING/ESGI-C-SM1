<?php

namespace Core\Auth;

use App\Models\User;
use Core\Session\PHPSession;

class Authenticator extends PHPSession
{
    private const SESSION_KEY_USER = 'auth.user';

    private ?User $user = null;

    public function login(User $user): void
    {
        $this->set(self::SESSION_KEY_USER, $user->getId());
    }

    public function logout(): void
    {
        $this->delete(self::SESSION_KEY_USER);
    }

    public function getUser(): ?User
    {
        if ($this->user) {
            return $this->user;
        }

        $userId = $this->get(self::SESSION_KEY_USER);

        if ($userId) {
            try {
                $user       = new User();
                $this->user = $user->getOneBy(['id' => $userId], 'object');

                return $this->user;
            } catch (\Exception $e) {
                $this->logout();

                return null;
            }
        }

        return null;
    }
}
