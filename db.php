<?php

function dbconnect($user,$pass,$host,$port,$db,$charset) {
    // Paramètres
    // $host    = 'localhost';
    // $db      = 'nom_de_votre_base';
    // $user    = 'votre_utilisateur';
    // $pass    = 'votre_mot_de_pass';
    // $charset = 'utf8mb4';
    // $port    = '3306';

    static $pdo = null; // Cette variable survit d'un appel à l'autre

    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retourne les données sous forme de tableaux associatifs
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Utilise les vraies requêtes préparées (plus sécurisé)
    ];

    try {

        // Si l'objet PDO n'a pas déjà été créé
        if ($pdo === null) {
            
            // On crée l'objet PDO immédiatement
            $pdo = new PDO($dsn, $user, $pass, $options);
        }    
        
        // On retourne l'objet PDO
        return $pdo;

    } catch (\PDOException $e) {
        
        // En cas d'erreur, on affiche un message et on arrête le script
        error_log($e->getMessage());
        die("Erreur de connexion à la base de données.");
    }
}