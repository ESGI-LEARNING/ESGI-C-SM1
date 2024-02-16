<?php

namespace App\Models;

use Core\DB\Model;

class Page extends Model
{
    protected ?int $id = null;

    protected string $name;

    protected string $slug;
    protected string $metadescription;

    protected string $content;
    protected int $is_deleted = 0;
    protected string $created_at;
    protected string $updated_at;
    protected string $title;

    protected int $is_hidden = 1;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getMetadescription(): string
    {
        return $this->metadescription;
    }

    public function setMetadescription(string $metadescription): void
    {
        $this->metadescription = $metadescription;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getIsDeleted(): int
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(int $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getIsHidden(): int
    {
        return $this->is_hidden;
    }

    public function setIsHidden(int $isHidden): void
    {
        $this->is_hidden = $isHidden;
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

    public function meta($title, $metadescription): Page
    {
        $this->setTitle($title);
        $this->setMetadescription($metadescription);

        return $this;
    }
}
