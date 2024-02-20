<?php

namespace App\Models;

use Core\DB\Model;
use Core\DB\Relation\HasOne;

class InformationPhotograph extends Model
{
    protected ?int $id = null;

    protected ?string $firstname = null;

    protected ?string $lastname = null;

    protected ?string $user_id = null;

    protected ?string $description = null;

    protected ?string $city = null;

    protected ?string $country = null;

    protected int $is_deleted = 0;

    protected string $created_at;

    protected string $updated_at;

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

    public function getfirstname(): string
    {
        return $this->firstname;
    }

    public function setfirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function getlastname(): string
    {
        return $this->lastname;
    }

    public function setlastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function getIsDeleted(): int
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(int $id_deleted): void
    {
        $this->is_deleted = $id_deleted;
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

    public function getUserId(): ?string
    {
        return $this->user_id;
    }

    public function setUserId(?string $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
