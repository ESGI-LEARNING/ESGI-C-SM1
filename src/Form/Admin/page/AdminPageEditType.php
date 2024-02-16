<?php

namespace App\Form\Admin\page;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class AdminPageEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'mettre à jour',
                'class'  => 'form',
            ],
            'inputs' => [
                'title' => [
                    'label'       => 'Titre de la page',
                    'type'        => 'text',
                    'value'       => $this->data->title ?? '',
                    'placeholder' => 'Nom de la page',
                ],
                'name' => [
                    'label'       => 'Nom',
                    'type'        => 'text',
                    'value'       => $this->data->name ?? '',
                    'placeholder' => 'Nom de la page',
                ],
                'metadescription' => [
                    'label'       => 'Meta description',
                    'input'       => FormTypeEnum::INPUT_TEXTAREA,
                    'value'       => $this->data->metadescription ?? '',
                    'placeholder' => 'Meta description de la page',
                    'rows'        => '6',
                ],
                'content' => [
                    'label'       => 'Contenu',
                    'type'        => 'textarea',
                    'id'          => 'mytextarea',
                    'value'       => $this->data->content ?? '',
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
            'metadescription' => ['required', 'min:3', 'max:255'],
        ];
    }
}
