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
  - [ ] Reset password
    - [ ] Envoi de mail
    - [ ] Génération de token

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