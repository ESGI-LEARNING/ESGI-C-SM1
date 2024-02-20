<?php

namespace App\Form\Admin\Article;

use App\Enum\FormTypeEnum;
use App\Models\Category;
use Core\Form\FormType;

class AdminArticleType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Enregistrer',
                'class'  => 'form',
            ],
            'inputs' => [
                'name' => [
                    'label'       => 'Nom',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'nom de l\'article',
                    'value'       => $this->data->getName(),
                    'errors'      => [],
                ],
                'categories[]' => [
                    'label'          => 'Categories',
                    'input'          => FormTypeEnum::INPUT_SELECT,
                    'multiple'       => true,
                    'class'          => 'input-form',
                    'value'          => $this->pluck($this->data->categories) ?? [],
                    'options'        => Category::findAll(),
                    'errors'         => [],
                    'type'           => '',
                ],
                'images[]' => [
                    'label'       => 'Images',
                    'type'        => 'file',
                    'multiple'    => true,
                    'class'       => 'input-form',
                    'placeholder' => 'images',
                    'images'      => $this->data->images ?? [],
                    'value'       => [],
                    'errors'      => [],
                ],
                'description' => [
                    'label'       => 'Description',
                    'class'       => 'input-form',
                    'placeholder' => 'description',
                    'value'       => $this->data->getDescription(),
                    'errors'      => [],
                    'rows'        => 6,
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'images[]'    => ['required'],
        ];
    }
}
