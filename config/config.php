<?php

// Définition de l'environnement : dev ou prod
define('ENV', 'dev'); 

// Configuration des accès aux bases de données
$dbConfig = [
    'dev' => [
        'host'    => 'localhost',
        'port'    => '3306',
        'dbname'  => 'artbox',
        'user'    => 'root',
        'pass'    => '',
        'charset' => 'utf8mb4'
    ],
    'prod' => [
        'host'    => 'localhost',
        'port'    => '3307',
        'dbname'  => 'artbox',
        'user'    => 'root',
        'pass'    => 'root',
        'charset' => 'utf8mb4'
    ]
];

// Gestion des erreurs selon l'environnement
if (ENV === 'dev') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
}

// Quelque soit l'environnement, on garde l'écriture dans le fichier log
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ . '/../logs/php_errors.log');
