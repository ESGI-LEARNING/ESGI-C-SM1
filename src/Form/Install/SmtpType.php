<?php

namespace App\Form\Install;

use Core\Form\FormType;

class SmtpType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Valider',
                'class' => 'form',
            ],
            'inputs' => [
                'host' => [
                    'label' => 'Host',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => 'smtp.exemple.fr',
                ],
                'port' => [
                    'label' => 'Port',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => '587',
                ],
                'username' => [
                    'label' => 'Username',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => 'smtp user',
                ],
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'class' => 'input-form',
                ],
                'from' => [
                    'label' => 'From email',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => 'no-reply@exemple.fr',
                ],
                'name' => [
                    'label' => 'Name email',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => 'No reply',
                ],
                'email' => [
                    'label' => 'Votre Email',
                    'type' => 'text',
                    'class' => 'input-form',
                    'placeholder' => 'votre@exemple.fr',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'host' => ['required'],
            'port' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'from' => ['required'],
            'name' => ['required'],
            'email' => ['required'],
        ];
    }
}