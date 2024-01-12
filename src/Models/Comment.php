<?php

namespace App\Models;

use Core\DB\Model;
use DateTime;

class Comment extends Model
{
    protected ?int $id = null;

    protected ?string $content = null;

    private ?string $content = null;

    private bool $isReported = false;

    protected int $user_id;

    protected int $is_deleted = 0;

    protected ?int $comment_id = null;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function isReported(): int
    {
        return $this->is_reported;
    }

    public function setIsReported(int $isReported): void
    {
        $this->is_reported = $is_reported;
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
    public function getComment(): Comment
    {
        return $this->comment_id;
    }

    public function setComment(int $comment_id): void
    {
        $this->comment_id = $comment_id;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = date('Y-m-d H:i:s', strtotime($created_at));
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
}
