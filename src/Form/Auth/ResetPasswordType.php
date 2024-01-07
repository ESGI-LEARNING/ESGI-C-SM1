<?php

namespace App\Form\Auth;

use Core\Form\FormType;

class ResetPasswordType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Réinitialiser le mot de passe',
                'class'  => 'form',
            ],
            'inputs' => [
                'password' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'nouveau mot de passe',
                ],
                'password_confirm' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'confirm'     => 'Nouveau mot de passe',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'password' => ['required', 'min:8', 'confirm'],
        ];
    }
}
