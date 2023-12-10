<?php

namespace App\Form\Auth;

class RegisterType
{
    public function getConfig(): array
    {
        return [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => "S'inscrire",
                'class'  => 'form',
            ],
            'inputs' => [
                'Prénom' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'minlen'      => 2,
                    'required'    => true,
                    'error'       => 'Le prénom doit faire plus de 2 caractères'],

                'Nom' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom',
                    'minlen'      => 2,
                    'required'    => true,
                    'error'       => 'Le nom doit faire plus de 2 caractères'],

                'Email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'required'    => true,
                    'error'       => "Le format de l'email est incorrect"],

                'Mot de passe' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'mot de passe',
                    'required'    => true,
                    'error'       => 'Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre'],

                'Confirmation du mot de passe' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'confirm'     => 'password',
                    'placeholder' => 'confirmation',
                    'required'    => true,
                    'error'       => 'Votre mot de passe de confirmation ne correspond pas'],
            ],
        ];
    }

    public function registerUser(array $userData): bool
    {
        $verificationToken = $this->generateVerificationToken();

        if ($verificationToken) {
            return $this->sendVerificationEmail($userData, $verificationToken);
        }

        return false;
    }

    private function generateVerificationToken(): ?string
    {
        try {
            return bin2hex(random_bytes(16));
        } catch (\Exception $e) {
            return null;
        }
    }

    private function sendVerificationEmail(array $userData, string $verificationToken): bool
    {
        $subject = 'Vérification de votre adresse email';
        $message = 'Bonjour '.$userData['Prénom'].', veuillez cliquer sur ce lien pour vérifier votre email: https://www.example.com/verify?token='.$verificationToken;
        $headers = 'From: webmaster@example.com';

        if (filter_var($userData['Email'], FILTER_VALIDATE_EMAIL)) {
            return mail($userData['Email'], $subject, $message, $headers);
        }

        return false;
    }
}
