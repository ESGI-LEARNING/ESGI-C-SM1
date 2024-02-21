<?php

namespace App\Form\Admin\page;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class AdminPageCreateType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Créer',
                'class'  => 'form',
            ],
            'inputs' => [
                'name' => [
                    'label'       => 'Nom',
                    'type'        => 'text',
                    'placeholder' => 'Nom de la page',
                ],
                'slug' => [
                    'label'       => 'Slug',
                    'type'        => 'text',
                    'placeholder' => 'Slug de la page',
                ],
                'metadescription' => [
                    'label'       => 'Meta description',
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'placeholder' => 'Meta description de la page',
                    'rows'        => '6',
                ],
                'content' => [
                    'label'       => 'Contenu',
                    'type'        => 'textarea',
                    'id'          => 'mytextarea',
                    'value'       => '',
                    'placeholder' => 'Contenu de la page',
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'rows'        => '6',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'name'            => ['required', 'min:3', 'max:255'],
            'slug'            => ['required', 'min:3', 'max:255'],
            'metadescription' => ['required', 'min:3', 'max:255'],
            'content'         => ['required', 'min:3', 'max:255'],
        ];
    }
}
