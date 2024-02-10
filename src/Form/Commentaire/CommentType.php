<?php

namespace App\Form;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class CommentType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '/articles/create/' . $this->data->getId(), // Action adaptée en fonction de votre logique
                'submit' => 'Envoyer',
                'class'  => 'form',
            ],
            'inputs' => [
                'comment' => [
                    'label'       => 'Votre commentaire :',
                    'type'        => FormTypeEnum::INPUT_TEXTAREA,
                    'class'       => 'input-form',
                    'placeholder' => 'Votre commentaire...',
                    'value'       => $this->data->getContent(),
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'comment' => ['required', 'min:3'], // Même nom que l'attribut "name" dans le formulaire HTML
        ];
    }
}

