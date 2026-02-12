<?php

// 1. On active l'affichage des erreurs à l'écran
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');

// 2. On définit le niveau d'erreur (E_ALL pour tout voir, même les petits avertissements)
// error_reporting(E_ALL);

// 3. On garde quand même l'écriture dans le fichier log
ini_set('log_errors', 'On');
ini_set('error_log', __DIR__ .'/../logs/php_errors.log');