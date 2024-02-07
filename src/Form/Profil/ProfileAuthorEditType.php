<?php

namespace App\Form\Profil;

use App\Enum\FormTypeEnum;
use Core\Auth\Auth;
use Core\Form\FormType;

class ProfileAuthorEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '/profile/edit-author',
                'submit' => "Modifier l'utilisateur",
                'class'  => 'form',
            ],
            'inputs' => [
                'firstName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'prénom',
                    'value'       => Auth::author()->firstname ?? '',
                    'errors'      => [],
                ],
                'lastName' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom',
                    'value'       => Auth::author()->lastname ?? '',
                    'errors'      => [],
                ],
                'description' => [
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => Auth::author()->description ?? '',
                    'errors'      => [],
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'rows'        => '5',
                ],
                'city' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'ville',
                    'value'       => Auth::author()->city ?? '',
                    'errors'      => [],
                ],
                'country' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'pays',
                    'value'       => Auth::author()->country ?? '',
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
