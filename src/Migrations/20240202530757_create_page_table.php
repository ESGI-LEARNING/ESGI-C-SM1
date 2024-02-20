<?php

namespace App\Migrations;

use App\Models\Image;
use Core\DB\Migration\BaseMigration;

class CreatePageTable extends BaseMigration
{
    public function __construct()
    {
        parent::__construct(Image::class);
    }

    public function up(): void
    {
        $sql = "
            CREATE TABLE IF NOT EXISTS `esgi_page` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(40) NOT NULL,
                `title` VARCHAR(40) NOT NULL,
                `slug` VARCHAR(40) NOT NULL,
                `metadescription` TEXT NOT NULL,
                `content` LONGTEXT NOT NULL,
                `is_deleted` TINYINT(1) DEFAULT 0,
                `is_hidden` TINYINT(1) DEFAULT 0,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP
            );

            INSERT INTO
                `esgi_page` (name, title, metadescription, slug, content)
            VALUES
                ('Accueil', 'Accueil', 'accueil', '/', 'Contenu de la page d\'accueil'),
                ('Contact', 'Contact', 'contact', '/contact', 'Contenu de la page de contact'),
                ('À propos', 'a-propos', 'a-propos', '/about-us', 'Contenu de la page à propos'),
                ('Galerie', 'galerie', 'galerie', '/gallery', 'Contenu de la galerie');
        ";
        $this->execute($sql);
    }
}
