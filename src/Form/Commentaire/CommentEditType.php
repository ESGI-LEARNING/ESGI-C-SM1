<?php

namespace App\Form\Commentaire;

use Core\Form\FormType;

class CommentEditType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => "Modifier le commentaire",
                'class'  => 'form',
            ],
            'inputs' => [
                'content' => [
                    'type'        => 'textarea',
                    'class'       => 'input-form',
                    'placeholder' => 'Contenu du commentaire',
                    'value'       => $this->data->getContent() ?? '',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'min:3'],
        ];
    }
}
