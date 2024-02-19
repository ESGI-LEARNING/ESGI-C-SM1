<?php

namespace App\Form\Profil;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class ProfileAuthorEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '/profile/author',
                'submit' => "Modifier l'utilisateur",
                'class'  => 'form',
            ],
            'inputs' => [
                'firstName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => $this->data->firstname ?? '',
                    'errors'      => [],
                ],
                'lastName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom',
                    'value'       => $this->data->lastname ?? '',
                    'errors'      => [],
                ],
                'description' => [
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => $this->data->description ?? '',
                    'errors'      => [],
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'rows'        => '5',
                ],
                'city' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'ville',
                    'value'       => $this->data->city ?? '',
                    'errors'      => [],
                ],
                'country' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'pays',
                    'value'       => $this->data->country ?? '',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'firstName'   => ['required', 'min:3'],
            'lastName'    => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'city'        => ['required', 'min:3'],
            'country'     => ['required', 'min:3'],
        ];
    }
}
