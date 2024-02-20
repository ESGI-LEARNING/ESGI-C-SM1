<?php

namespace App\Form;

use App\Enum\FormTypeEnum;
use Core\Form\FormType;

class FormContactType extends FormType
{
    public function setConfig(): void
    {
        $this->config = [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => "Envoyer",
                'class'  => 'form',
            ],
            'inputs' => [
                'username' => [
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'Nom',
                    'value'       => '',
                    'errors'      => [],
                ],
                'email' => [
                    'type'        => 'email',
                    'class'       => 'input-form',
                    'placeholder' => 'email',
                    'value'       => '',
                    'errors'      => [],
                ],
                'content' => [
                    'type'        => 'content',
                    'input'       =>  FormTypeEnum::INPUT_TEXTAREA,
                    'rows'        => 10,
                    'class'       => 'input-form',
                    'placeholder' => 'Votre message',
                    'value'       => '',
                    'errors'      => [],
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'username' => ['required', 'min:3'],
            'email'    => ['email', 'required'],
            'content'    => ['require', 'min:10'],
        ];
    }
}