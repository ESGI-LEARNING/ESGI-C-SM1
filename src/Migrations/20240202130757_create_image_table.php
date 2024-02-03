<?php

namespace App\Migrations;

use App\Models\Image;
use Core\DB\Migration\BaseMigration;

class CreateImageTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Image::class);
    }

    public function up(): void
    {
        $sql = "
        CREATE TABLE `{$this->getTable()}`
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    image      VARCHAR(255) NOT NULL,
    picture_id INT          NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_photos_images FOREIGN KEY (picture_id) REFERENCES `{$this->getPrefix()}picture` (id) ON DELETE CASCADE
);
";

        $this->execute($sql);
    }
}
