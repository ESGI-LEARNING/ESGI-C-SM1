<?php

namespace App\Migrations;

use Core\DB\Migration\BaseMigration;

class CreatePictureCommentTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getPrefix()}picture_comment`
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    picture_id INT NOT NULL,
    comment_id INT NOT NULL,

    CONSTRAINT FK_pictures_pictures_comments FOREIGN KEY (picture_id) REFERENCES `{$this->getPrefix()}picture` (id) ON DELETE CASCADE,
    CONSTRAINT FK_comments_pictures_comments FOREIGN KEY (comment_id) REFERENCES `{$this->getPrefix()}comment` (id) ON DELETE CASCADE
);";

        $this->execute($sql);
    }
}
