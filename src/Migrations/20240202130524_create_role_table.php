<?php

namespace App\Migrations;

use App\Models\Role;
use Core\DB\Migration\BaseMigration;

class CreateRoleTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Role::class);
    }

    public function up(): void
    {
        $sql = "CREATE TABLE `{$this->getTable()}` (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(40) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO `{$this->getTable()}` (name) VALUES ('ROLE_ADMIN');
INSERT INTO `{$this->getTable()}` (name) VALUES ('ROLE_USER');
INSERT INTO `{$this->getTable()}` (name) VALUES ('ROLE_AUTHOR');

CREATE TABLE `{$this->getPrefix()}user_role`
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,

    CONSTRAINT FK_users_roles FOREIGN KEY (user_id) REFERENCES `{$this->getPrefix()}user` (id) ON DELETE CASCADE,
    CONSTRAINT FK_roles_users FOREIGN KEY (role_id) REFERENCES `{$this->getPrefix()}role` (id) ON DELETE CASCADE
);
";

        $this->execute($sql);
    }
}
