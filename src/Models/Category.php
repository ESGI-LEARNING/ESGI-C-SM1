<?php

namespace App\Models;

use Core\DB\Model;

class Category extends Model
{
    private ?int $id = null;

    public function __construct()
    {
        parent::__construct($this);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }
}
