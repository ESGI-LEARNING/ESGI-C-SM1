CREATE DATABASE esgi_c_sm1;
USE esgi_c_sm1;

CREATE TABLE Pages
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    slug         VARCHAR(100) UNIQUE,
    content      TEXT,
    user_id      INT,
    is_published BOOLEAN      NOT NULL DEFAULT 1,
    created_at   DATETIME              DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME              DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users (id)
);

CREATE TABLE Roles
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE roles_users
(
    id      INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    role_id INT,
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (role_id) REFERENCES Roles (id)
);

CREATE TABLE Comments
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    content     TEXT    NOT NULL,
    is_reported TINYINT NOT NULL DEFAULT 0,
    created_at  DATETIME         DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME         DEFAULT CURRENT_TIMESTAMP,
    user_id     INT,
    FOREIGN KEY (user_id) REFERENCES Users (id)
);

CREATE TABLE Comment_reply
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    content     TEXT    NOT NULL,
    is_reported TINYINT NOT NULL DEFAULT 0,
    created_at  DATETIME         DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME         DEFAULT CURRENT_TIMESTAMP,
    user_id     INT,
    comment_id  INT,
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (comment_id) REFERENCES Comments (id)
);

CREATE TABLE Materials
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    url          VARCHAR(255),
    image        VARCHAR(255),
    user_id      INT,
    picture_id   INT,
    created_at   DATETIME              DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME              DEFAULT CURRENT_TIMESTAMP,
    slug         VARCHAR(100) UNIQUE,
    content      TEXT,
    is_published TINYINT      NOT NULL DEFAULT 1
);

CREATE TABLE Users
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    username   VARCHAR(50)  NOT NULL,
    email      VARCHAR(100) NOT NULL,
    avatar     VARCHAR(255),
    password   VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reset_token_password
(
    email      VARCHAR(100),
    token      VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (email) REFERENCES Users (email)
);

CREATE TABLE Pictures
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(100) NOT NULL,
    slug         VARCHAR(100) UNIQUE,
    path         VARCHAR(255),
    description  TEXT,
    is_published TINYINT NOT NULL DEFAULT 1,
    created_at   DATETIME         DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME         DEFAULT CURRENT_TIMESTAMP,
    user_id      INT,
    FOREIGN KEY (user_id) REFERENCES Users (id)
);

CREATE TABLE picture_material
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT,
    picture_id  INT,
    FOREIGN KEY (material_id) REFERENCES Materials (id),
    FOREIGN KEY (picture_id) REFERENCES Pictures (id)
);

CREATE TABLE pictures_categories
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    picture_id  INT,
    category_id INT,
    FOREIGN KEY (picture_id) REFERENCES Pictures (id),
    FOREIGN KEY (category_id) REFERENCES Category (id)
);

CREATE TABLE Info_photograph
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    ville       VARCHAR(100),
    code_postal VARCHAR(10),
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Category
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(100) NOT NULL,
    slug       VARCHAR(100) UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Templates
(
    name        VARCHAR(100) NOT NULL,
    description TEXT,
    created_at  DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Logs
(
    user_id    INT AUTO_INCREMENT PRIMARY KEY,
    action     VARCHAR(50),
    subject    VARCHAR(100),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES Users (id)
);

CREATE TABLE settings
(
    id         INT AUTO_INCREMENT PRIMARY KEY,
    key_token  VARCHAR(100) NOT NULL,
    value      VARCHAR(100) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
