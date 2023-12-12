<?php

namespace App\Form\Auth;

class LoginType
{
    public function getConfig(): array
    {
        return [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Se connecter',
                'class'  => 'form',
            ],
            'inputs' => [
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
            ],
        ];
    }
}
