<?php

// Inclusion de l'entête de chaque page du site
include 'header.php';

// Inclusion des données sur les oeuvres a présenter sur le site
include 'oeuvres.php';

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
