<?php

namespace App\Entity;

use App\Entity\Trait\GeneralEntityTrait;

class Comment
{
    use GeneralEntityTrait;

    public string $content;
    public bool $is_reported;
    public User $user;

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function isIsReported(): bool
    {
        return $this->is_reported;
    }

    public function setIsReported(bool $is_reported): void
    {
        $this->is_reported = $is_reported;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }


}