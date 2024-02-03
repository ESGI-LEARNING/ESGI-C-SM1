<?php

namespace App\Migrations;

use App\Models\Log;
use Core\DB\Migration\BaseMigration;

class CreateLogTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Log::class);
    }

    public function up(): void
    {
        $sql = "
        CREATE TABLE `{$this->getTable()}`
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT         NOT NULL,
    action     VARCHAR(40) NOT NULL,
    subject    VARCHAR(40) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_users_logs FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id) ON DELETE CASCADE
);
";

        $this->execute($sql);
    }
}
