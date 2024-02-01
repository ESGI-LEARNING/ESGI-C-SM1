<?php

namespace App\Form\Article;

use App\Enum\FormTypeEnum;
use App\Models\Category;
use Core\Form\FormType;

class AdminArticleCreateType extends FormType
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
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom de l\'article',
                    'value'       => '',
                    'errors'      => [],
                ],
                'category' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'catégorie',
                    'value'       => '',
                    'options'     => Category::findAll(),
                    'errors'      => [],
                ],
                'image' => [
                    'type'        => 'file',
                    'class'       => 'input-form',
                    'placeholder' => 'image',
                    'value'       => '',
                    'errors'      => [],
                ],
                'description' => [
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => '',
                    'errors'      => [],
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'min:3'],
            'category'    => ['required', 'min:3'],
            'image'       => ['required'],
            'description' => ['required', 'min:3'],
        ];
    }
}
