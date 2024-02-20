<?php

namespace App\Migrations;

use App\Models\ResetPassword;
use Core\DB\Migration\BaseMigration;

class CreateResetPasswordTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(ResetPassword::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}`
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    user_id    INT          NOT NULL,
    token      VARCHAR(255) NOT NULL,
    expired_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT FK_users_reset_passwords FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id) ON DELETE CASCADE
);";

        $this->execute($sql);
    }
}
