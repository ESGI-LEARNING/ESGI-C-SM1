<?php

namespace App\Mails;

use Core\Mailer\Mailer;

class AuthMail
{
    public function sendVerifyEmail(string $email, array $data): void
    {
        $mail = new Mailer();
        $mail->send(
            $email,
            'Vérification de votre compte',
            'auth/confirm-email',
            'auth/verify-email',
            $data
        );
    }

    public function sendResetPassword(string $email, array $data): void
    {
        $mail = new Mailer();
        $mail->send(
            $email,
            'Réinitialisation de votre mot de passe',
            'auth/reset-password',
            'auth/reset-password',
            $data
        );
    }
}