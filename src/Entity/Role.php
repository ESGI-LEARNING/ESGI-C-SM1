<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class Role
{
    use GeneralEntityTrait;

    public string $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}