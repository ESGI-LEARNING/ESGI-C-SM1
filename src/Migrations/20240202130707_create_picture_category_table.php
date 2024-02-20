<?php

namespace App\Migrations;

use Core\DB\Migration\BaseMigration;

class CreatePictureCategoryTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getPrefix()}picture_category`
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    picture_id  INT NOT NULL,
    category_id INT NOT NULL,

    CONSTRAINT FK_pictures_pictures_categories FOREIGN KEY (picture_id) REFERENCES `{$this->getPrefix()}picture` (id) ON DELETE CASCADE,
    CONSTRAINT FK_categories_pictures_categories FOREIGN KEY (category_id) REFERENCES `{$this->getPrefix()}category` (id) ON DELETE CASCADE
);";

        $this->execute($sql);
    }
}
