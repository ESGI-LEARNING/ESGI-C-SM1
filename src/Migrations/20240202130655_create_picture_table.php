<?php

namespace App\Migrations;

use App\Models\Picture;
use Core\DB\Migration\BaseMigration;

class CreatePictureTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Picture::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}`
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(40) NOT NULL,
    slug        VARCHAR(50) NOT NULL,
    description TEXT        NOT NULL,
    user_id     INT         NOT NULL,
    is_deleted  TINYINT(1) DEFAULT 0,
    created_at  DATETIME   DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME   DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_users_pictures FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id)
);";

        $this->execute($sql);
    }
}
