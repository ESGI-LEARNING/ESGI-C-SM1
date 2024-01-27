<?php

namespace App\Form\Admin\User;

use Core\Form\FormType;

class AdminUserCreateType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Créer',
                'class'  => 'form',
            ],
            'inputs' => [
                'username' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => '',
                    'errors'      => [],
                ],
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'value'       => '',
                    'errors'      => [],
                ],
                'password' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'mot de passe',
                    'errors'      => [],
                ],
                'password_confirm' => [
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'confirm'     => 'password',
                    'placeholder' => 'confirmation',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3'],
            'email'    => ['email', 'required'],
            'password' => ['required', 'min:8', 'confirm'],
        ];
    }
}
