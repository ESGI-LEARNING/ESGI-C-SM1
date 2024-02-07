<?php

namespace Core\Auth;

use App\Models\InformationPhotograph;
use App\Models\User;

class Auth extends Authenticator
{
    public static function user(): User
    {
        return (new Auth())->getUser();
    }

    public static function author(): InformationPhotograph
    {
        $author = new InformationPhotograph();

        return $author::query()->where('user_id', '=', Auth::id())->get()[0];
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
