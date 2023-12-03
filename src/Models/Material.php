<?php

namespace App\Models;

use App\core\DB\DB;

class Material extends DB
{
   private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

}
