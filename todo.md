## hello word

### Core application

- Class Security
- Class Envoie de mail (SwitfMailer)'
- Class Form builder
- Class ORM custom
- Class Serveur s3
- Class Config (gère tout les fichier de configuration)

### Fonctionnalités

- [ ] Installation de l'environnement via une interface WEB
    - [ ] Description de l'installation
    - [ ] Connexion à la base de données
    - [ ] Ionformation sur l'installation
        - [ ] Nom du projet
        - [ ] Identifiant admin
        - [ ] Mot de passe admin (génération mot de passe)
        - [ ] Email admin
    - [ ] Redirection vers la page de login admin

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
    - [ ] Profile
    - [ ] Home
    - [ ] About
    - [ ] Gallery (avec filtre catégories)
        - [ ] Show
        - [ ] Contact

- [ ] Gestion des pages
    - [ ] Profile
    - [ ] Home
    - [ ] About
    - [ ] Gallery (avec filtre catégories)
        - [ ] Show
        - [ ] Contact

- [ ] Framework css
    - [ ] Dark-mode
    - [ ] Light-mode
    - [ ] Responsive

# Contraintes par matières :

- [ ] PHP8
    - [ ] Environnement docker
    - [ ] Intégration de design pattern singleton
    - [ ] Namespace
    - [ ] POO
    - [ ] Autoloader
    - [ ] Mise en production

- [ ] Intégration Web :
    - [ ] Framework de composants + classes utilitaires
    - [ ] Compilation Sass à partir de variables
    - [ ] Mobile first et dark mode
    - [ ] Utilisation exclusive d’unités relatives
    - [ ] Utilisation obligatoire de variables css pour la configuration du templating

# Fonctionnalités principales /15 :

- [ ] Installation de l’environnement via une interface WEB
- [ ] Authentification
    - [ ] Register avec activation du compte par email
    - [ ] Login
    - [ ] Logout
    - [ ] Reset password
- [ ] Gestion du compte utilisateur (modification / suppression (hard et soft delete) )
- [ ] Gestion de menu dynamique
- [ ] Système de routing via fichier YAML
- [ ] Gestion des commentaires
- [ ] Panel d’administration
    - [ ] Dashboard avec de la datavisualisation
    - [ ] Configuration du templating
    - [ ] CRUD des commentaires et modération
    - [ ] CRUD Utilisateur et gestion des rôles (Minimum 3)
    - [ ] Optimisation SEO (Bonnes pratiques)
    - [ ] CRUD des pages
    - [ ] Modération des commentaires (Notification)
- [ ] SiteMap XML
- [ ] ORM lite