<?php

// Inclusion des paramètres généraux de configuration
require_once ('./config/config.php');

// Inclusion des paramètres et de la fonction de connexion à la DB
require_once 'db.php';

// Inclusion de l'entête de chaque page du site
include 'header.php';

// connexion à la DB
// $pdo = dbconnect($user,$pass,$host,$port,$db,$charset);
$pdo = dbconnect($dbConfig);


// Récupération de la liste des oeuvres
$query = $pdo->query("SELECT id, titre,artiste, description, image FROM oeuvres");
$oeuvres = $query->fetchAll();


// Affichage des oeuvres 
echo "<div id=\"liste-oeuvres\">";

// Pour chacune des oeuvres récupérées dans le tableau PHP $oeuvres, on affiche un bloc contenant : 
// . Une image de l'oeuvre
// . Son titre
// . Le nom de l'artiste
// Le tout est doté d'un lien vers une page détail de l'oeuvre

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
