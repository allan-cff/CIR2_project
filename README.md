# CIR2_project
## Installation du projet en local (WSL Debian)
- Accéder à la page d'accueil de VSCode (si un dossier est ouvert : Fichier -> Fermer le dossier)
- Lancer VSCode dans la WSL (coin inférieur gauche)
- Créer un compte github et demander l'accès collaborateur
- Installer Git sur la WSL `sudo apt install git`
- Configurer Git `git config --global user.name "VotreNom"` et `git config --global user.email "votre@email"`
- Suivre le tuto [Getting started with GitHub Pull Requests and Issues](https://code.visualstudio.com/docs/sourcecontrol/github)
- Cliquer sur Clone Git Repository
- Cliquer sur Clone From GitHub
- Sélectionner allan-cff/CIR2_project
- Cloner dans /var/www/html/

## Installation du projet sur le serveur distant
- Créer un compte github et demander l'accès collaborateur
- Installer Git sur le serveur `sudo apt install git`
- Configurer Git `git config --global user.name "VotreNom"` et `git config --global user.email "votre@email"`
- Se déplacer dans /var/www/html/
- Cloner le repo `sudo git clone https://allan-cff@github.com/allan-cff/CIR2_project`

## Mettre à jour le serveur distant
- Se déplacer dans /var/www/html/
- Pull depuis GitHub `sudo git pull`

## Créer un lien SSH vers le serveur distant dans VSCode
- Installer l'extension VSCode SSH FS
- Suivre le [tuto](https://www.cse.unsw.edu.au/~learn/homecomputing/sshfs-remote/)
- Host 10.10.51.79
- Port 22
- Username user1
- Password IsenCIR2

## Générer les données SQL
- Se rendre dans le dossier `CIR2_project/SQL/insert`
- Installer python3 et pip3
- Installer les dépendances `python3 -m pip install --force-reinstall https://github.com/yt-dlp/yt-dlp/archive/master.tar.gz
pip install psycopg2`
- Lancer le script (remplis la base de données dev_db avec l'utilisateur web_project)
- Récupérer le script de backup `sudo pg_dump -U postgres dev_db > fill.sql`

## Créer la base de données
- Se rendre dans le dossier `CIR2_project/SQL`
- Démarrer postgreSQL `sudo service postgresql start`
- Se connecter à PostgreSQL en compte super admin `sudo -u postgres psql`
- Créer un role `create role www login password 'IsenCIR2';`
- Créer un role `create role admin login password 'IsenCIR2';`
- Créer une base de données `create database rythmic owner admin;`
- Sortir de l'invite de commande postgresql `\q`
- Lancer le script `psql -U admin rythmic < insert/fill.sql`
- (POUR TESTS UNIQUEMENT) Executer `psql dev_db postgres` `\i SQL/data.sql`

## Insérer des valeurs dans la base de données
