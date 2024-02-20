<?php

namespace App\Form\Profil;

use Core\Form\FormType;

class ProfileEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => "Modifier l'utilisateur",
                'class'  => 'form',
            ],
            'inputs' => [
                'username' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => $this->data->username ?? '',
                    'errors'      => [],
                ],
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'value'       => $this->data->email ?? '',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3'],
            'email'    => ['email', 'required'],
        ];
    }
}
