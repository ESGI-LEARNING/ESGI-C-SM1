<?php

namespace App\Migrations;

use App\Models\InformationPhotograph;
use Core\DB\Migration\BaseMigration;

class CreateInformationPhotographTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(InformationPhotograph::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}` (
                id          INT AUTO_INCREMENT PRIMARY KEY,
                user_id     INT NOT NULL,
                firstname   VARCHAR(40) NOT NULL,
                lastname    VARCHAR(40) NOT NULL,
                description TEXT NOT NULL,
                city        VARCHAR(58),
                country     VARCHAR(58),
                is_deleted  TINYINT(1) DEFAULT 0,
                created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
                
                CONSTRAINT FK_users_information_photograph
                FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id) ON DELETE CASCADE
        )";


        $this->execute($sql);
    }
}
