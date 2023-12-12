<?php

namespace App\Form\Auth;

class ResetPasswordType
{
    public function getConfig(): array
    {
        return [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Réinitialiser le mot de passe',
                'class'  => 'form',
            ],
            'inputs' => [
                'Email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'required'    => true,
                    'error'       => "Le format de l'email est incorrect",
                ],
                'Nouveau mot de passe' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'nouveau mot de passe',
                    'required'    => true,
                    'error'       => 'Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre',
                ],
                'Confirmation du mot de passe' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'confirm'     => 'Nouveau mot de passe',
                    'placeholder' => 'confirmation',
                    'required'    => true,
                    'error'       => 'Votre mot de passe de confirmation ne correspond pas',
                ],
            ],
        ];
    }

    public function sendResetEmail(string $email, string $token): bool
    {
        $subject = 'Réinitialisation de mot de passe';
        $message = 'Veuillez cliquer sur ce lien pour réinitialiser votre mot de passe: https://www.example.com/reset?email='.$email.'&token='.$token;
        $headers = 'From: webmaster@example.com';

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return mail($email, $subject, $message, $headers);
        }

        return false;
    }

    public function generateResetToken(): ?string
    {
        try {
            return bin2hex(random_bytes(16));
        } catch (\Exception $e) {
            return null;
        }
    }
}
