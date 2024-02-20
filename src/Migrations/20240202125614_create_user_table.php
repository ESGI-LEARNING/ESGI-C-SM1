<?php

namespace App\Migrations;

use App\Models\User;
use Core\DB\Migration\BaseMigration;

class CreateUserTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}` (
        id         INT AUTO_INCREMENT PRIMARY KEY,
        username   VARCHAR(40)  NOT NULL,
        email      VARCHAR(320) NOT NULL,
        password   VARCHAR(255) NOT NULL,
        avatar     VARCHAR(255),
        verify     TINYINT(1) DEFAULT 0,
        is_deleted TINYINT(1) DEFAULT 0,
        created_at DATETIME   DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME   DEFAULT CURRENT_TIMESTAMP
    );";

        $this->execute($sql);
    }
}
