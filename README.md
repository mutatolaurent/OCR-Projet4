# Projet 4 : Mettez en place un serveur et un site simple avec PHP

## Objectif

Application web PHP permettant la gestion d’œuvres stockées en base de données.

### Fonctionnalités principales

- Page d’accueil listant les œuvres
- Page de détail d’une œuvre
- Formulaire d’ajout d’une nouvelle œuvre

## Architecture du projet

/(racine) => scripts php

/config => paramètres de configuration (dont accès base de données)

/db => script SQL d’initialisation de la base artbox

/logs => journalisation des erreurs (php_errors.log)

/style => feuilles de styles

/img => visuels du site (dont le logo)

## Points techniques développés

### Exploitation d'une BD MySQL

- Création et initialisation de la BD
- Récupération des données pour affichage
- Insertion de nouvelles données via un formulaire dédié

### Gestion des erreurs

- Utilisation des **Exceptions**
- Encapsulation des accès BD dans des blocs `try/catch`
- Journalisation des erreurs SQL et applicatives dans `logs/php_errors.log`

### Validation du formulaire

- Validation côté serveur (sans JavaScript)
- Messages d’erreur spécifiques par champ
- Mise en évidence visuelle des champs invalides
- Conservation des données saisies en cas d’erreur
- Utilisation des variables de session

### Gestion des environnements

- Switch DEV / PROD via variable d’environnement définie dans `config.php`
- Configuration du serveur de base de données adaptée à l’environnement

## Technologies utilisées

- PHP
- MySQL
- HTML / CSS
