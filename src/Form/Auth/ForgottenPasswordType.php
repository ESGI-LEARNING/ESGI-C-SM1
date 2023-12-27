<?php

namespace App\Form\Auth;

use Core\Form\FormType;

class ForgottenPasswordType extends FormType
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
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'email' => ['email', 'exist:user.email'],
        ];
    }

}
