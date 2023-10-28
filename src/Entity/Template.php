<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class Template
{
    use GeneralEntityTrait;

    public string $name;

    public string $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}