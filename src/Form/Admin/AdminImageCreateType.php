<?php

namespace App\Form\Admin;

use Core\Form\FormType;

class AdminImageCreateType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => "Ajouter l'image",
                'class'  => 'form',
            ],
            'inputs' => [
                'objet' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom de l\'image',
                    'value'       => '',
                    'errors'      => [],
                ],
                'slug' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'slug',
                    'value'       => '',
                    'errors'      => [],
                ],
                'description' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => '',
                    'errors'      => [],
                ],
                'image' => [
                    'type'        => 'file',
                    'class'       => 'input-form',
                    'placeholder' => 'image',
                    'value'       => '',
                    'errors'      => [],
                ],
                'photographe' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'photographe',
                    'value'       => '',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'objet'       => ['required', 'min:3'],
            'slug'        => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'image'       => ['required', 'min:3'],
            'photographe' => ['required', 'min:3'],
        ];
    }
}
