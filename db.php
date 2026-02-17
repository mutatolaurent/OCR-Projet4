<?php

/**
 * Initialise et retourne une instance unique de connexion PDO (Singleton).
 *
 * Cette fonction utilise l'injection de dépendances pour recevoir ses paramètres
 * de configuration et s'appuie sur une variable statique pour ne pas multiplier
 * les connexions au serveur de base de données durant l'exécution du script.
 *
 * @param array $configDB   Tableau multidimensionnel contenant les identifiants indexés par environnement (ex: $configTable['dev']).
 * * @throws \PDOException  Si la connexion échoue (l'erreur est logguée avant l'arrêt).
 * @return \PDO             Instance de la connexion active.
 */
function dbconnect(array $configDB) {

    // l'objet de connexion est initialisé comme variable static de façon à ce qu'il reste en mémoire d'un appel à l'autre
    // Cette technique permet d'éviter de recréer une nouvelle connexion à MySQL à chaque appel de la fonction
    static $pdo = null; // Cette variable survit d'un appel à l'autre

    // Si l'objet PDO n'a pas déjà été créé
    if ($pdo === null) {
            
        // On sélectionne la config en fonction de l'environnement
        $config = $configDB[ENV];

        // Initialisation de la chaîne de connexion
        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset={$config['charset']}";

        // Initialisation des options de connexion à la DB
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Active les exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retourne les données sous forme de tableaux associatifs
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Utilise les vraies requêtes préparées (plus sécurisé)
        ];

        try {
            // On crée l'objet PDO
            $pdo = new PDO($dsn, $config['user'], $config['pass'], $options);
            
        } catch (\PDOException $e) {
            error_log("Erreur de connexion : " . $e->getMessage());
            header('Location: errors.php');
            exit;   
            
        }

    }    
        
    // On retourne l'objet PDO
    return $pdo;

}