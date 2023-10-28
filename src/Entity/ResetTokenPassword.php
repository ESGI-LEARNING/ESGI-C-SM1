<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class ResetTokenPassword
{
    use GeneralEntityTrait;
    public User $email;
    public string $token;

    public function getEmail(): User
    {
        return $this->email;
    }

    public function setEmail(User $email): void
    {
        $this->email = $email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }



}