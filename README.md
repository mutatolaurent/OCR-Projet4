# Projet 4 : Mettez en place un serveur et un site simple avec PHP

Pour initialiser ce projet, je suis parti de mes propres fichiers sources réalisés au titre de l'exercice 2 du projet 2.

Les fichiers disponibles dans ce dépo répondent aux objectifs du projet 4 :

- Une page d’accueil pour récupérer les œuvres en base de données.
- Une page de détail pour récupérer l’œuvre en base de données.
- Un formulaire d’ajout d’une nouvelle œuvre.

J'ai profité de ce projet pour pousser certains concepts un peu plus loin que prévu.

J'ai enrichi la structure de base avec les dossiers :

- config => contient un fichier avec les paramètres de config, principalement les credentials pour l'accès à la BD.
- db => contient le script d'initialisation de la db artbox.
- logs => contient un fichier php_errors.log dans lequel je trace toutes les erreurs et exceptions.

J'ai exploré la technique des Exceptions et des structure try/Throw/Catch pour la gestion des erreurs. Tous les accès à la BD sont encapsulées dans des structure try/catch.

J'ai réalisé la gestion des erreurs du formulaire de façon à :

- cibler chaque champ en erreur par un feedback qui affiche un message spéfique et change le style des contours du champ.
- éviter à l'utilisateur de re-saisir tous les champs du formulaire si un des champs est en erreur.

Pour réaliser cette gestion du feedback des erreurs au niveau du formulaire, j'ai utilisé des variables de session.
