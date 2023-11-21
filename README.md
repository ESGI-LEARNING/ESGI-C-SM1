# 📓 Projet semestriel 1 ESGI: Photographie

## Commande pour démarrer le projet

````bash
docker-compose up --build -d
docker-compose exec php yarn install
docker-compose exec php yarn build
docker-compose exec php composer install
````

# 📕 Maquette Figma

Lien vers la maquette: https://www.figma.com/file/fxuwFIXRyGMrFNJ42JuJuI/Challenge-Semestriel?type=design&node-id=0%3A1&mode=design&t=PXd58yYDrnCPGCni-1

## 💻 Outils utilisés:

- PHP 8.3
- Nginx
- Mariadb DB 
- PhpMyAdmin

## 💾 Installation 

Décrire la procédure d'installation du projets.

## 📃 Modèle conceptuel de données

![MCD](https://raw.githubusercontent.com/TheoMeunier/ESGI-C-SM1/main/documentation/mcd.png)

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
- Issam DJAIL - [Github](https://github.com/djouleissoum)
