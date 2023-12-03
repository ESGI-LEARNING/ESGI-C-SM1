<?php

namespace App\Models;

use Core\DB\DB;

class Roles extends DB
{
    private ?int $id = null;

    private string $name;

    private \DateTime $created_at;

    private \DateTime $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
