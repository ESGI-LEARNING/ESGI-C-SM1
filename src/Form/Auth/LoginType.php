<?php

namespace App\Form\Auth;

use Core\Form\FormType;

class LoginType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Se connecter',
                'class'  => 'form',
            ],
            'inputs' => [
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'required'    => true,
                    'error'       => "Le format de l'email est incorrect"],

                'password' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'mot de passe',
                    'required'    => true,
                    'error'       => 'Votre mot de passe doit faire plus de 8 caractères avec minuscule et chiffre'],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'min:8', 'alphanum'],
        ];
    }
}
