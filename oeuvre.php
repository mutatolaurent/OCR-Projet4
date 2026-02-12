<?php
include 'header.php';
include 'oeuvres.php';

// Récupèration de l'identifiant de l'oeuvre passé en paramètre de la page
$id = $_GET['id'];

// Contrôle de l'existence de l'ID et récupération des données de l'œuvre
$oeuvreTrouvee = null;
foreach ($oeuvres as $oeuvre) {
    if ($oeuvre['id'] == $id) {
        $oeuvreTrouvee = $oeuvre;
        break;
    }
}

// Si l'oeuvre n'est pas trouvé => affichage d'un message d'erreur
if ($oeuvreTrouvee === null) {
    echo "<p>Œuvre non trouvée.</p>";
    include 'footer.php';
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

<!-- Inclusion du pide de page du site -->
<?php include 'footer.php'; ?>