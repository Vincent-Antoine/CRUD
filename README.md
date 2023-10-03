Projet CRUD Symfony
Ce projet est une application simple réalisée avec Symfony permettant d'effectuer des opérations CRUD (Create, Read, Update, Delete) sur des utilisateurs et leurs contacts.

🌟 Fonctionnalités
Enregistrement des utilisateurs : Création d'un nouveau compte utilisateur.
Connexion / Déconnexion des utilisateurs : Accès sécurisé à votre espace personnel.
Gestion des contacts : Ajout, édition, consultation et suppression de vos contacts.

🛠 Prérequis
PHP 7.4 ou supérieur.
Composer
Symfony CLI
Serveur de base de données (ex. MySQL).
Une base de données SQL est incluse dans ce projet. Vous pouvez l'installer et l'utiliser pour tester l'application.

🔧 Installation
Cloner le dépôt:
git clone https://github.com/votre-nom-d-utilisateur/votre-nom-de-depot.git

Installer les dépendances:
cd votre-nom-de-depot
composer install

Configurer la base de données:

Ouvrez le fichier .env et ajustez la ligne DATABASE_URL pour refléter votre configuration de base de données.

Créer la base de données et appliquer les migrations:

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

Lancer le serveur de développement:
symfony server:start
Ouvrez votre navigateur et accédez à http://localhost:8000 pour voir l'application en action.

💼 Utilisation
Accédez à /register pour créer un compte utilisateur.
Une fois inscrit, connectez-vous via /login.
Après la connexion, vous pourrez ajouter, éditer, consulter et supprimer vos contacts.
