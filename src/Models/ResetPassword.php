<?php

namespace App\Models;

use Core\DB\Model;

class ResetPassword extends Model
{
    protected ?int $id = null;

    protected ?string $token = null;

    protected int $user_id;

    protected string $created_at;

    protected string $expired_at;

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

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(): void
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    public function getExpiredAt(): string
    {
        return $this->expired_at;
    }

    public function setExpiredAt(string $expired_at): void
    {
        $this->expired_at = $expired_at;
    }
}
