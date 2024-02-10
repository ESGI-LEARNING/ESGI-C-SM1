<?php

namespace App\Form\Admin\User;

use App\Enum\FormTypeEnum;
use App\Models\Role;
use Core\Form\FormType;

class AdminUserEditType extends FormType
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
                    'value'       => $this->data->getUsername() ?? '',
                    'errors'      => [],
                ],
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'value'       => $this->data->getEmail() ?? '',
                    'errors'      => [],
                ],
                'roles[]' => [
                    'label'       => 'Roles',
                    'input'       => FormTypeEnum::INPUT_SELECT,
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'value'       => $this->pluck($this->data->roles) ?? [],
                    'options'     => Role::findAll(),
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
