<?php

namespace App\Migrations;

use Core\DB\Migration\BaseMigration;

class CreatePictureMaterialTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct();
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getPrefix()}picture_material`
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    picture_id  INT NOT NULL,
    material_id INT NOT NULL,

    CONSTRAINT FK_pictures_pictures_materials FOREIGN KEY (picture_id) REFERENCES `{$this->getPrefix()}picture` (id) ON DELETE CASCADE,
    CONSTRAINT FK_materials_pictures_materials FOREIGN KEY (material_id) REFERENCES `{$this->getPrefix()}material` (id) ON DELETE CASCADE
);";

        $this->execute($sql);
    }
}
