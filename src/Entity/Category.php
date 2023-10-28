<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class Category
{
    use GeneralEntityTrait;

    public string $name;
    public string $slug;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }


}