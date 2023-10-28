<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class Setting
{
    use GeneralEntityTrait;
    public string $key_token;
    public string $value;

    public function getKeyToken(): string
    {
        return $this->key_token;
    }

    public function setKeyToken(string $key_token): void
    {
        $this->key_token = $key_token;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }


}