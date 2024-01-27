<?php

namespace App\Form\Admin\Category;

use Core\Form\FormType;

class AdminCategoryType extends FormType
{

    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Créer la catégorie',
                'class'  => 'form',
            ],
            'inputs' => [
                'name' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom',
                    'value'       => $this->data->getName(),
                    'errors'      => [],
                ]
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
        ];
    }
}