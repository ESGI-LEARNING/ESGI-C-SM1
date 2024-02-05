## hello word

### Core application

- Class Security
- Class Envoie de mail (PhpMailer)'
- Class Form builder
- Class ORM custom
- Class Config (gère tout les fichier de configuration)

### Fonctionnalités

- [x] Installation de l'environnement via une interface WEB
    - [x] Description de l'installation
    - [x] Connexion à la base de données
    - [x] Ionformation sur l'installation
        - [x] Nom du projet
        - [x] Identifiant admin
        - [x] Mot de passe admin (génération mot de passe)
        - [x] Email admin
    - [x] Redirection vers la page de login admin

- [x] Authentification
    - [x] Register
        - [ ] Envoi de mail de verification avec token
        - [x] (username, email, password, confirm password)
    - [x] Login
        - [x] (username, password)
    - [x] Logout
    - [x] Reset password
        - [x] Envoi de mail
        - [x] Génération de token

- [ ] Gestion des commentaires
    - [ ] Créer un commentaire
    - [ ] Lister les commentaires
    - [ ] Supprimer un commentaire
    - [ ] Modifier un commentaire

- [ ] Gestion des pages
    - [x] Profile
    - [x] Home
    - [x] About
    - [ ] Gallery (avec filtre catégories)
        - [ ] Show
        - [ ] Contact

- [ ] Framework css
    - [x] Dark-mode
    - [x] Light-mode
    - [ ] Responsive

# Contraintes par matières :

- [ ] PHP8
    - [x] Environnement docker
    - [x] Intégration de design pattern singleton
    - [x] Namespace
    - [x] POO
    - [x] Autoloader
    - [x] Mise en production

- [x] Intégration Web :
    - [ ] Framework de composants + classes utilitaires
    - [x] Compilation Sass à partir de variables
    - [ ] Mobile first et dark mode
    - [ ] Utilisation exclusive d’unités relatives
    - [ ] Utilisation obligatoire de variables css pour la configuration du templating

# Fonctionnalités principales /15 :

- [x] Installation de l’environnement via une interface WEB
- [x] Authentification
    - [x] Register avec activation du compte par email
    - [x] Login
    - [x] Logout
    - [x] Reset password
- [x] Gestion du compte utilisateur (modification / suppression (hard et soft delete) )
- [ ] Gestion de menu dynamique
- [x] Système de routing via fichier YAML
- [x] Gestion des commentaires
- [x] Panel d’administration
    - [ ] Dashboard avec de la datavisualisation
    - [ ] Configuration du templating
    - [x] CRUD des commentaires et modération
    - [x] CRUD Utilisateur et gestion des rôles (Minimum 3)
    - [x] Optimisation SEO (Bonnes pratiques)
    - [ ] CRUD des pages
    - [x] Modération des commentaires (Notification)
- [x] SiteMap XML
- [x] ORM lite
      - [x] Show
      - [x] Contact

- [ ] Framework css
  - [x] Dark-mode
  - [x] Light-mode
  - [ ] Responsive
