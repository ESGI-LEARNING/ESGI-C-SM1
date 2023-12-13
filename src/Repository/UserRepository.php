<?php

namespace App\Repository;

use App\Models\User;
use Core\DB\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
}
