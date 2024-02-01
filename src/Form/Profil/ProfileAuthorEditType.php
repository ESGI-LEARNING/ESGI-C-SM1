<?php

namespace App\Form\Profil;

use App\Enum\FormTypeEnum;
use App\Models\InformationPhotograph;
use Core\Auth\Auth;
use Core\Form\FormType;

class ProfileAuthorEditType extends FormType
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
                'firstName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => '',
                    'errors'      => [],
                ],
                'lastName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom',
                    'value'       => '',
                    'errors'      => [],
                ],
                'description' => [
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => '',
                    'errors'      => [],
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'rows'        => '5',
                ],
                'city' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'ville',
                    'value'       => '',
                    'errors'      => [],
                ],
                'country' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'pays',
                    'value'       => '',
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
