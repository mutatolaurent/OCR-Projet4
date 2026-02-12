<?php

// Inclusion des paramètres généraux de configuration
require_once ('./config/config.php');
// 1. On active l'affichage des erreurs à l'écran
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');

// 2. On définit le niveau d'erreur (E_ALL pour tout voir, même les petits avertissements)
// error_reporting(E_ALL);

// 3. On garde quand même l'écriture dans le fichier log
// ini_set('log_errors', 'On');
// ini_set('error_log', __DIR__ . '/logs/php_errors.log');

// Inclusion des paramètres de connexion à la DB
require_once ('./config/mysql.php');

// Inclusion des paramètres et de la fonction de connexion à la DB
require_once 'db.php';

// Inclusion de l'entête de chaque page du site
include 'header.php';

// Inclusion des données sur les oeuvres a présenter sur le site
// include 'oeuvres.php';

// connexion à la DB
$pdo = dbconnect($user,$pass,$host,$port,$db,$charset);

// Récupération de la liste des oeuvres
$query = $pdo->query("SELECT id, titre,artiste, description, image FROM oeuvres");
$oeuvres = $query->fetchAll();




// Affichage des oeuvres 
echo "<div id=\"liste-oeuvres\">";

// Pour chacune des oeuvres récupérées dans le tableau PHP $oeuvres, on affiche un bloc contenant : 
// . Une image de l'oeuvre
// . Son titre
// . Le nom de l'artiste
// Le tout estdoté d'un lien vers une page détail de l'oeuvre

foreach ($oeuvres as $oeuvre) {
  echo "<article class=\"oeuvre\">";
  echo "<a href=\"oeuvre.php?id=" . $oeuvre['id'] . "\">";
  echo "<img src=\"" . $oeuvre['image'] . "\" alt=\"" . htmlspecialchars($oeuvre['titre']) . "\" />";
  echo "<h2>" . htmlspecialchars($oeuvre['titre']) . "</h2>";
  echo "<p class=\"description\">" . htmlspecialchars($oeuvre['artiste']) . "</p>";
  echo "</a>";
  echo "</article>";
}
echo "</div>";

// Inclusion du pied de page du site
include 'footer.php';
