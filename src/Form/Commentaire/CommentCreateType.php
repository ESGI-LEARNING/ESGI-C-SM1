<?php

namespace App\Form\Commentaire;

use Core\Form\FormType;

class CommentCreateType extends FormType
{
    public function setConfig(): void
    {
        $articleId = $this->data->getId();

        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => "/articles/create/{$articleId}",
                'submit' => "Envoyer",
                'class'  => 'form',
            ],
            'inputs' => [
                'article_id' => [
                    'type'  => 'hidden',
                    'value' => $articleId,
                ],
                'comment' => [
                    'type'        => 'textarea',
                    'class'       => 'input-form',
                    'placeholder' => 'Votre commentaire',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'comment' => ['required', 'min:3'],
        ];
    }
}
