<?php

namespace App\Controllers;

use App\core\Views\View;

class SecurityController
{
    public function login(): void
    {
        $myView = new View("security/login", "front");
    }

    public function register(): void
    {
        $myView = new View("security/register", "front");
    }

    public function logout(): void
    {
        $myView = new View("security/logout", "front");
    }
}
