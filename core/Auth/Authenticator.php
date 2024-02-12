<?php

namespace Core\Auth;

use App\Models\User;
use Core\Session\PHPSession;

class Authenticator extends PHPSession
{
    private const SESSION_KEY_USER = 'auth.user';

    private ?User $user = null;

    public static function generateToken(string $email): string
    {
        return hash('sha512', config('app.url').'/verify-email/'.$email);
    }

    public function login(User $user): void
    {
        $this->set(self::SESSION_KEY_USER, $user->getId());
    }

    public function getUser(): ?User
    {
        if ($this->user instanceof User) {
            return $this->user;
        }

        $userId = $this->get(self::SESSION_KEY_USER);
        if ($userId) {
            try {
                $user          = new User();
                $retrievedUser = $user->findBy(['id' => $userId]);

                if ($retrievedUser instanceof User) {
                    $this->user = $retrievedUser;

                    return $this->user;
                } else {
                    $this->logout();

                    return null;
                }
            } catch (\Exception $e) {
                $this->logout();

                return null;
            }
        }

        return null;
    }

    public function logout(): void
    {
        $this->delete(self::SESSION_KEY_USER);
    }
}
