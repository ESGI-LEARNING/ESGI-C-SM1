<?php

namespace App\Models;

use Core\DB\Model;
use Core\DB\Relation\BelongToMany;
use Core\DB\Relation\HasMany;
use Core\DB\Relation\HasOne;

class Picture extends Model
{
    protected ?int $id = null;

    protected ?string $name = null;

    protected string $slug;

    protected ?string $description = null;

    protected int $user_id;

    protected int $is_deleted = 0;

    protected string $created_at;

    protected ?string $image; 

    protected string $updated_at;

    protected ?string $username;
    
    // protected ?int $picture_id = null;

    //  protected ?int $comment_id = null;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getIsDeleted(): int
    {
        return $this->is_deleted;
    }

    public function setIsDeleted(int $is_deleted): void
    {
        $this->is_deleted = $is_deleted;
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

    public function image(): HasMany
    {
        return $this->hasMany(Image::class, 'picture_id', 'id');
    }

    public function categories(): BelongToMany
    {
        return $this->belongsToMany(Category::class, 'picture_category', 'picture_id', 'category_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function comments(): BelongToMany
    {
        return $this->belongsToMany(Comment::class, 'picture_comment', 'picture_id', 'comment_id');
    }

}
