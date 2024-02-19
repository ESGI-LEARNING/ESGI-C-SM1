<?php

namespace App\Models;

use App\Service\GlideService;
use Core\DB\Model;
use Core\DB\Relation\BelongToMany;

class User extends Model
{
    protected ?int $id = null;

    protected ?string $username = null;

    protected ?string $email = null;

    protected string $password;

    protected ?string $avatar = null;

    protected int $is_deleted = 0;

    protected int $verify = 0;

    protected string $created_at;

    protected string $updated_at;

     protected ?int $user_id = null;

     protected ?int $role_id = null;
     
     protected ?string $name = null;

    public function __construct()
    {
        parent::__construct($this);

        $this->setCreatedAt(date('Y-m-d H:i:s'));
        $this->setUpdatedAt(date('Y-m-d H:i:s'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username =  ucwords(strtolower(trim($username)));
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_ARGON2ID);
    }

    public function avatar(): string
    {
        return GlideService::getLinkImage($this->avatar, 150, 150);
    }

    public function getAvatar(): string
    {
        return $this->avatar();
    }

    public function setAvatar(?string $avatar): void
    {
        $this->avatar = $avatar;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }

    public function getIsDeleted(): int
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(int $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
    }

    public function getIdVerify(): int
    {
        return $this->verify;
    }

    public function setVerify(int $verify): void
    {
        $this->verify = $verify;
    }

    public function roles(): BelongToMany
    {
        return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id');
    }

    public function author(): BelongToMany
    {
        return $this->belongsToMany(InformationPhotograph::class, 'information_photograph', 'user_id', 'id');
    }
}
