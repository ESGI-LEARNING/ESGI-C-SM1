<?php

namespace App\Form\Install;

use Core\Form\FormType;

class AdminUserType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Valider',
                'class'  => 'form',
            ],
            'inputs' => [
                'username' => [
                    'label'       => 'Username',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'username',
                ],
                'email' => [
                    'label'       => 'Email',
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'exemple@gmail.fr',
                ],
                'password' => [
                    'label'       => 'Password',
                    'type'        => 'password',
                    'class'       => 'input-form',
                ],
                'password_confirm' => [
                    'label'       => 'Confirmation',
                    'type'        => 'password',
                    'class'       => 'input-form',
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
