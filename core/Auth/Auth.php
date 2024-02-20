<?php

namespace Core\Auth;

use App\Models\User;

class Auth extends Authenticator
{
    public static function user(): User
    {
        return (new Auth())->getUser();
    }

    public static function id(): int
    {
        return (new Auth())->getUser()->getId();
    }

    public static function check(): bool
    {
        if ((new Auth())->getUser() === null) {
            return false;
        }

        return true;
    }
}
