<?php

namespace App\Form\Admin\User;

use App\Enum\FormTypeEnum;
use App\Models\Role;
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
                    'label'       => 'Nom',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => '',
                    'errors'      => [],
                ],
                'email' => [
                    'label'       => 'Email',
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'value'       => '',
                    'errors'      => [],
                ],
                'roles[]' => [
                    'label'       => 'Roles',
                    'input'       => FormTypeEnum::INPUT_SELECT,
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'value'       => [],
                    'options'     => Role::findAll(),
                    'errors'      => [],
                ],
                'password' => [
                    'label'       => 'Password',
                    'type'        => 'password',
                    'class'       => 'input-form',
                    'placeholder' => 'mot de passe',
                    'errors'      => [],
                ],
                'password_confirm' => [
                    'label'       => 'Confirm Password',
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
