<?php

namespace Core\Form;

class AbstractForm
{
    public function isSubmitted(): bool
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public function isValid(): bool
    {
        return true;
    }

    public function getData(): array
    {
        return $_POST;
    }

    public function getConfig(): array
    {
        return [];
    }
}