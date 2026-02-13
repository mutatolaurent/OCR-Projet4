<?php

// Inclusion des paramètres généraux de configuration
require_once ('./config/config.php');

// Inclusion des paramètres et de la fonction de connexion à la DB
require_once 'db.php';

// Inclusion de l'entête de chaque page du site
include 'header.php';

// Si l'identifiant de l'oeuvre est absent ou vide on trace l'erreur et on revient à la page d'accueil
if (!isset($_GET['id']) || $_GET['id'] === '') {
    
    // On trace l'erreur de le journal des erreurs
    error_log("ERREUR[oeuvre.php] l'identifiant de l'oeuvre est incorrect (absent ou vide) ");

    // On redirige vers la page d'accueil
    header('Location: index.php');
    exit;
}

// Contrôle du type du paramètre
// Si c'est un entier il est disponible dans $id
// Si ce n'est pas entier ou s'il est négatif, $id est un booleen initialisé à false
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

// Si ce n'est pas un entier ou s'il est négatif on trace l'erreur et on revient à la page d'accueil
if ($id === false || $id <= 0) {

    // On trace l'erreur dans le journal des erreurs
    error_log("ERREUR[oeuvre.php] l'identifiant de l'oeuvre n'est pas un entier valide ou est négatif ");

    // On redirige vers la page d'accueil
    header('Location: index.php');
    exit;
}

// connexion à la DB
$pdo = dbconnect($dbConfig);

// Récupération en DB des informations sur l'oeuvre grâce à son ID
$stmt = $pdo->prepare("SELECT id, titre, artiste, description, image FROM oeuvres WHERE id = :id");
$stmt->execute(['id' => $id]);
$oeuvreTrouvee = $stmt->fetch();

// Si L'ID est un entier valide, mais qu'il n'existe pas en base de données, on trace l'erreur et on revient à la page d'accueil
if (!$oeuvreTrouvee) {

    // On trace l'erreur dans le journal des erreurs
    error_log("ERREUR[oeuvre.php] l'identifiant : ".$id." ne correspond à aucune oeuvre référencée en BD");

    // On redirige vers la page d'accueil
    header('Location: index.php');
    exit;

}
?>

<!-- Affichage des détails de l'oeuvre -->
<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?php echo htmlspecialchars($oeuvreTrouvee['image']); ?>" alt="<?php echo htmlspecialchars($oeuvreTrouvee['titre']); ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?php echo htmlspecialchars($oeuvreTrouvee['titre']); ?></h1>
        <p class="description"><?php echo htmlspecialchars($oeuvreTrouvee['artiste']); ?></p>
        <p class="description-complete">
            <?php echo htmlspecialchars($oeuvreTrouvee['description']); ?>
        </p>
    </div>
</article>

<!-- Inclusion du pied de page du site -->
<?php include 'footer.php'; ?>