-- Crée la base de données
CREATE DATABASE projetPremierSemestre;

-- Sélectionne la base de données
USE  projetPremierSemestre;

-- Crée la table "Pages"
CREATE TABLE Pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    comment_reply TEXT,
    is_published BOOLEAN NOT NULL DEFAULT 1
);

-- Crée la table "Roles"
CREATE TABLE Roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crée la table "roles_users" pour gérer la relation entre utilisateurs et rôles
CREATE TABLE roles_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (role_id) REFERENCES Roles(id)
);

-- Crée la table "Comments"
CREATE TABLE Comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    content TEXT NOT NULL,
    is_reported BOOLEAN NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    page_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (page_id) REFERENCES Pages(id)
);

-- Crée la table "Materials"
CREATE TABLE Materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    url VARCHAR(255),
    image VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    slug VARCHAR(255) UNIQUE,
    content TEXT,
    is_published BOOLEAN NOT NULL DEFAULT 1
);

-- Crée la table "Users"
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    avatar VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reset_token_password VARCHAR(255),
    path VARCHAR(255),
    token VARCHAR(255)
);

-- Crée la table "templates"
CREATE TABLE Templates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    action VARCHAR(255)
);

-- Crée la table "Logs"
CREATE TABLE Logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    key VARCHAR(255),
    subject VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crée la table "Pictures"
CREATE TABLE Pictures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    is_published BOOLEAN NOT NULL DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT
);

-- Crée la table "picture_material" pour gérer la relation entre images et matériaux
CREATE TABLE picture_material (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT,
    picture_id INT,
    FOREIGN KEY (material_id) REFERENCES Materials(id),
    FOREIGN KEY (picture_id) REFERENCES Pictures(id)
);

-- Crée la table "pictures_categories" pour gérer la relation entre images et catégories
CREATE TABLE pictures_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    picture_id INT,
    category_id INT,
    FOREIGN KEY (picture_id) REFERENCES Pictures(id),
    FOREIGN KEY (category_id) REFERENCES Category(id)
);

-- Crée la table "Info_photograph"
CREATE TABLE Info_photograph (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    ville VARCHAR(255),
    code_postal VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    slug VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
?>