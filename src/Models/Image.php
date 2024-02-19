<?php

namespace App\Models;

use App\Service\GlideService;
use Core\DB\Model;
use Core\DB\Relation\HasOne;

class Image extends Model
{
    protected ?int $id = null;

    protected string $image;

    protected int $picture_id;

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

    public function getImage(): string
    {
        return $this->image;
    }

    public function image(?int $width, ?int $height): string
    {
        return GlideService::getLinkImage($this->image, 300, 300);
    }

    public function getPictureId(): int
    {
        return $this->picture_id;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
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

    public function setPictureId(int $picture_id): void
    {
        $this->picture_id = $picture_id;
    }

    public function picture(): HasOne
    {
        return $this->hasOne(Picture::class, 'id', 'picture_id');
    }
}
