<?php

namespace App\Controllers\Auth;

use App\Form\Auth\LoginType;
use App\Form\Auth\RegisterType;
use App\Form\Auth\ResetPasswordType;
use Core\Views\View;

class SecurityController
{
    public function login(): void
    {
        $form   = new LoginType();
        $config = $form->getConfig();
        $myView = new View('security/login', 'front', [
            'config' => $config,
        ]);
    }

    public function register(): void
    {
        $form   = new RegisterType();
        $config = $form->getConfig();
        $myView = new View('security/register', 'front', [
            'config' => $config,
        ]);
    }

    public function logout(): void
    {
        $myView = new View('security/logout', 'front');
    }

    public function resetPassword(): void
    {
        $form   = new ResetPasswordType();
        $config = $form->getConfig();
        $myView = new View('security/resetPassword', 'front', [
            'config' => $config,
        ]);
    }
}
