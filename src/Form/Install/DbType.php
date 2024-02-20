<?php

namespace App\Form\Install;

use Core\Form\FormType;

class DbType extends FormType
{
    public function setConfig(): void
    {
        $this->config =  [
            'config' => [
                'method' => 'POST',
                'action' => '',
                'submit' => 'Valider',
                'class'  => 'form',
            ],
            'inputs' => [
                'host' => [
                    'label'       => 'Host',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'localhost',
                ],
                'name' => [
                    'label'       => 'Name',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'db_name',
                ],
                'username' => [
                    'label'       => 'Username',
                    'type'        => 'text',
                    'class'       => 'input-form',
                    'placeholder' => 'db_user',
                ],
                'password' => [
                    'label'       => 'Password',
                    'type'        => 'password',
                    'class'       => 'input-form',
                ],
                'prefix' => [
                    'label'             => 'Prefix',
                    'type'              => 'text',
                    'class'             => 'input-form',
                    'placeholder'       => 'prefix',
                ],
                'sitename' => [
                    'label'             => 'Nom du site',
                    'type'              => 'text',
                    'class'             => 'input-form',
                    'placeholder'       => 'sitename',
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'host'     => ['required'],
            'name'     => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'prefix'   => ['required'],
        ];
    }
}
