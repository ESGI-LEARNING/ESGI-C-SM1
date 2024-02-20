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
                    'type'         => 'email',
                    'class'        => 'input-form',
                    'placeholder'  => 'email',
                    'required'     => true,
                    'errors'       => [],
                ],

                'password' => [
                    'type'         => 'password',
                    'class'        => 'input-form',
                    'placeholder'  => 'mot de passe',
                    'required'     => true,
                    'errors'       => [],
                ],
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
