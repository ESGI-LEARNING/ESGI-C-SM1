<?php

namespace App\Form\Article;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class AdminArticleEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Modifier l\'article',
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
                    'input'       => FormTypeEnum::INPUT_SELECT,
                    'class'       => 'input-form',
                    'placeholder' => 'catégorie',
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
}
