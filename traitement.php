<?php
session_start(); // Pour pouvoir écrire dans la session

// On vérifie que la méthode est bien POST
//
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // RAZ du tableau des erreurs
    $erreurs = [];

    // Init du tableau des données à partir des valeurs saisies dans les champs du formulaire
    $donnees = [
        'titre' => htmlspecialchars($_POST['titre']) ?? '',
        'artiste' => htmlspecialchars($_POST['artiste']) ?? '',
        'image' => htmlspecialchars($_POST['image']) ?? '',
        'description' => htmlspecialchars($_POST['description']) ?? ''
    ];

    // --- LOGIQUE DE VALIDATION ---

    // Le champ titre doit obligatoirement être renseigné
    if (empty($donnees['titre'])) {
        $erreurs['titre'] = "Le titre est obligatoire.";
    }

    // Le champ artiste doit obligatoirement être renseigné
    if (empty($donnees['artiste'])) {
        $erreurs['artiste'] = "Le nom de l'artiste est obligatoire.";
    }

    // Le champ image doit obligatoirement être renseigné et respecter le format standard des URL
    if (empty($donnees['image'])) {
        $erreurs['image'] = "Le lien vers l'image est obligatoire !";
    } elseif (!filter_var($donnees['image'], FILTER_VALIDATE_URL)) {
        $erreurs['image'] = "Ce lien n'est pas un lien conforme !";
    }
    
    // Le champ description doit obligatoirement être renseigné et d'une longueur d'au moins 3 caractères
    if (empty($donnees['description'])) {
        $erreurs['description'] = "Une description est nécessaire !";
    } elseif (strlen($donnees['description']) < 3) {
        $erreurs['description'] = "La description doit comporter au moins 3 caractères !";
    }


    // --- DÉCISION ---

    // SI (On a détecté des erreurs sur certains champs du formulaire) 
    if (!empty($erreurs)) {
        
        // On stocke les messages d'erreurs et les données saisies en session 
        // ce qui permettra au formulaire de récupérer le contexte et aisni :
        // . de conserver les données saisie par l'utilisateur de façon à ce qu'il n'ait pas à les re-saisir
        // . de désigner les champs en erreur et les causes d'erreur.
        $_SESSION['erreurs'] = $erreurs;
        $_SESSION['donnees'] = $donnees;

        // On renvoie l'utilisateur vers le formulaire
        header("Location: ajouter.php");
        exit;
    
    // SINON on insère les données du formulaire en BD et on affiche la page du détail de l'oeuvre
    } else {
        
        // Inclusion des paramètres généraux de configuration
        require_once ('./config/config.php');

        // Inclusion des paramètres et de la fonction de connexion à la DB
        require_once 'db.php';      

        // Init de l'objet d'accès à la BD
        $pdo = dbconnect($dbConfig);

        try {
            // Préparation de la requête d'insertion
            $req = $pdo->prepare('INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)');

            // Exécution de la requête d'insertion des données de l'oeuvre
            $req->execute([$donnees['titre'], $donnees['artiste'], $donnees['image'], $donnees['description']]);
        
        } catch (\PDOException $e) {

            // En cas d'erreur lors de la préparation de la requête d'insertion ou lors de son exécution
            // on trace l'erreur dans le fichier des erreurs et on affiche une page d'erreur
            error_log("[traitement.php]Erreur lors de l'insertion d'une oeuvre : " . $e->getMessage());
            header('Location: errors.php');
            exit;   
        }

        // $db->lastInsertId() permet de récupérer l'id de la dernière ligne insérée en base de données 
        // (en l'occurence, l'oeuvre que nous venons d'ajouter).        
        header('Location: oeuvre.php?id=' . $pdo->lastInsertId());    

    }

} else {
    // Si on accède au script sans POST, on redirige vers le formulaire
    header("Location: ajouter.php");
    exit;
}