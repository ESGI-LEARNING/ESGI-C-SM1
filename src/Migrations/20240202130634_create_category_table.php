<?php

namespace App\Migrations;

use App\Models\Category;
use Core\DB\Migration\BaseMigration;

class CreateCategoryTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Category::class);
    }

    public function up(): void
    {
        $sql = "
        CREATE TABLE `{$this->getTable()}`
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(40) NOT NULL,
    slug       VARCHAR(40) NOT NULL,
    is_deleted TINYINT(1) DEFAULT 0,
    created_at DATETIME   DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME   DEFAULT CURRENT_TIMESTAMP
);
";

        $this->execute($sql);
    }
}
