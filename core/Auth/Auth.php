<?php

namespace Core\Auth;

use App\Models\User;

class Auth extends Authenticator
{
    static public function user(): User
    {
        return (new Auth)->getUser();
    }

    static public function id(): Int
    {
        return (new Auth)->getUser()->getId();
    }

    static public function check(): Bool
    {
        if ((new Auth)->getUser() === null) {
            return false;
        }

        return true;
    }
}