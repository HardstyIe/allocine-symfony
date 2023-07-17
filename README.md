# Projet "Allocine Symfony"

Ce projet est une application web développée en utilisant le framework Symfony. L'application est conçue pour afficher une liste de films, d'acteurs, de réalisateurs et de catégories, et permettre aux utilisateurs de rechercher des films en fonction de différents critères tels que le titre, les acteurs, les réalisateurs et les catégories.

## Fonctionnalités

- Affichage d'une liste de films avec les détails tels que le titre, l'année de sortie, les acteurs, les réalisateurs et les catégories.
- Possibilité de rechercher des films en fonction du titre, des acteurs, des réalisateurs et des catégories.
- Affichage d'une liste d'acteurs, de réalisateurs et de catégories.
- Possibilité de rechercher des acteurs, des réalisateurs et des catégories.
- Ajout, édition et suppression de films, d'acteurs, de réalisateurs et de catégories (administration).

## Installation

```bash
# Clonez ce dépôt GitHub sur votre machine locale
git clone https://github.com/HardstyIe/allocine-symfony.git

# Installez les dépendances du projet avec Composer
composer install

# Configurez la base de données dans le fichier .env en spécifiant vos paramètres de connexion.

# Créez la base de données et exécutez les migrations pour créer les tables
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

# (Optionnel) Chargez les données de démonstration (fixtures)
php bin/console doctrine:fixtures:load

# Lancez le serveur Symfony
symfony server:start
```

L'application sera accessible à l'adresse http://http://127.0.0.1:8000.

## Utilisation

- Page d'accueil: Affiche la liste des films, des acteurs, des réalisateurs et des catégories.
- Page de recherche: Permet de rechercher des films en fonction du titre, des acteurs, des réalisateurs et des catégories.
- Pages de détails: Affichent les détails d'un film, d'un acteur, d'un réalisateur ou d'une catégorie spécifique.
- Pages d'administration: Accessibles uniquement par les administrateurs, elles permettent d'ajouter, d'éditer et de supprimer des films, des acteurs, des réalisateurs et des catégories.

## Autheur

[Hardstyle](https://github.com/HardstyIe)

## License

[MIT](https://choosealicense.com/licenses/mit/)

```

```
