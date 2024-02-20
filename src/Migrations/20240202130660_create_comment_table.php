<?php

namespace App\Migrations;

use App\Models\Comment;
use Core\DB\Migration\BaseMigration;

class CreateCommentTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Comment::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}`
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    content     TEXT NOT NULL,
    is_reported TINYINT(1) DEFAULT 0,
    user_id     INT  NOT NULL,
    comment_id  INT,
    picture_id  INT NOT NULL,
    is_deleted  TINYINT(1) DEFAULT 0,
    created_at  DATETIME   DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME   DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_users_comments FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id) ON DELETE CASCADE,
    CONSTRAINT FK_comments FOREIGN KEY (comment_id) REFERENCES `{$this->getPrefix()}comment` (id) ON DELETE CASCADE,
    CONSTRAINT FK_picture FOREIGN KEY (picture_id) REFERENCES `{$this->getPrefix()}picture` (id) ON DELETE CASCADE,
);";

        $this->execute($sql);
    }
}
