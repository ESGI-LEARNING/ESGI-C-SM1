# 📓 Projet semestriel 1 ESGI: Photographie

# 📚 Sommaire

- [📝 Contexte](#-contexte)
- [📑 Description fonctionnelle](#description-fonctionnelle)
- [📕 Maquette Figma](#-maquette-figma)
- [💻 Outils utilisés:](#-outils-utilisés)
- [💾 Installation](#-installation)
- [📃 Modèle conceptuel de données](#-modèle-conceptuel-de-données)
- [📌 Lien utiles](#-lien-utiles)
- [📋 Fonctionnalités principales](#-fonctionnalités-principales)
- [🍀 Fonctionnalités bonus:](#-fonctionnalités-bonus)
- [👤 Groupe](#-groupe)

# 📑 Description du projet

lien de la production: [https://esgi.theomeunier.fr/](https://esgi.theomeunier.fr/)

## 📝 Contexte

Ce projet permettra au photogrape de gérer son site vitrine. Il pourra ajouter des photos, des catégories, des pages, etc..
Il sera proposé une gallerie de photo avec un filtre par catégorie. Pour permettre de faire découvrir des photos au visiteur.
Chaque photo pourra être commenté par les visiteurs. Le photographe pourra modérer les commentaires.

## Description fonctionnelle

Cet outil de gestion de site vitrine offre une solution complète pour la création de sites web. Il dispose d'un moteur
de templating personnalisé basé sur le design pattern MVC (Modèle-Vue-Contrôleur), créé à partir de zéro pour garantir
une flexibilité maximale.

L'une de ses caractéristiques notables est l'intégration d'un framework de composants SASS, qui facilite la création
d'interfaces esthétiquement attrayantes et réactives. Pour accélérer le développement, l'outil utilise également ViteJS,
un environnement de développement rapide.

Avec cet outil, les développeurs peuvent concevoir des sites vitrines avec une grande efficacité tout en maintenant un
haut niveau de personnalisation et de contrôle.

# 📕 Maquette Figma

Lien vers la
maquette: https://www.figma.com/file/fxuwFIXRyGMrFNJ42JuJuI/Challenge-Semestriel?type=design&node-id=0%3A1&mode=design&t=PXd58yYDrnCPGCni-1

## 💻 Outils utilisés:

- PHP 8.3
- Nginx
- Mariadb DB
- PhpMyAdmin

## 💾 Installation

Décrire la procédure d'installation du projets.

````bash
docker-compose up --build -d
docker-compose exec php composer install
docker-compose exec php yarn install
docker-compose exec php yarn build si APP_ENV=prod // ou 
docker-compose exec php yarn dev si APP_ENV=dev
````

Créer un fichier `.env` à la racine du projet avec les variables suivantes:
Si vous êtes en développement, vous pouvez utiliser le fichier `.env.example` pour vous aider.

## 📃 Modèle conceptuel de données

![MCD](https://raw.githubusercontent.com/TheoMeunier/ESGI-C-SM1/main/documentation/mcd/MCD.png)

## 📌 Lien utiles

- Github: https://github.com/TheoMeunier/ESGI-C-SM1
- YouTrack: https://youtrack.theomeunier.fr
- Email - serveur smtp: https://mail.theomeunier.fr
- Notion: https://www.notion.so/Projet-Challenge-Semestriel-SM1-3IW1-e1c9b30b217a4c03baefb8970b26e6e8?pvs=4
- MCD: https://excalidraw.com/#json=FXlmxoF_6CspwXzozmYbO,KoXlJp6CelQQGFRPxBftuw

## 📋 Fonctionnalités principales

- installation de l'environnement via une interface WEB
- Authentification
    - Register
    - Login
    - Logout
    - Reset password
- Gestion du compte utilisateur (update / suppression (hard et soft delete))
- Gestion de menu dynamique
- Système de routing via fichier YAML
- Gestion des commentaires (gestion de modération)
- Panel d'administration
    - Dashboard avec de la datavisualisation
    - Configuration du templating
    - CRUD des commentaires
    - CRUD utilisation et gestion des rôles (3)
    - Optimisation SEO (Bonne pratiques)
    - CRUD des pages
- SiteMap XML
- ORM Lite

## 🍀 Fonctionnalités bonus:

- Routing par annotation
- Multi-templating
- Design pattern Menento
- Intégration d'un CLI

## 👤 Groupe

- Théo MEUNIER - [Github](https://github.com/TheoMeunier)
- Philippe DELENTE - [Github](https://github.com/PhilDaiguille)
- Quentin ANDRIEU - [Github](https://github.com/Tinou95)