<?php 

session_start(); // Indispensable pour lire les données stockées

// On récupère les données et erreurs puis on vide la session immédiatement
$erreurs = $_SESSION['erreurs'] ?? [];
$donnees = $_SESSION['donnees'] ?? ['titre' => '', 'artiste' => '', 'image' => '', 'description' => ''];

// On nettoie la session pour que les messages ne restent pas au prochain rafraîchissement
unset($_SESSION['erreurs'], $_SESSION['donnees']);

// Insertion du header du site
require 'header.php'; ?>

<form action="traitement.php" method="POST">

    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre" <?= isset($donnees['titre']) ? 'value="'.$donnees['titre'].'"' : '' ?> <?= isset($erreurs['titre']) ? 'class="input-erreur"' : '' ?>>
        <?php if(isset($erreurs['titre'])): ?>
                <span class="erreur-texte"><?= $erreurs['titre'] ?></span>
        <?php endif; ?>
    </div>

    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste" <?= isset($donnees['artiste']) ? 'value="'.htmlspecialchars($donnees['artiste']).'"' : '' ?> <?= isset($erreurs['artiste']) ? 'class="input-erreur"' : '' ?>>
        <?php if(isset($erreurs['artiste'])): ?>
                <span class="erreur-texte"><?= $erreurs['artiste'] ?></span>
        <?php endif; ?>
    </div>

    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image" <?= isset($donnees['image']) ? 'value="'.htmlspecialchars($donnees['image']).'"' : '' ?> <?= isset($erreurs['image']) ? 'class="input-erreur"' : '' ?>>
        <?php if(isset($erreurs['image'])): ?>
                <span class="erreur-texte"><?= $erreurs['image'] ?></span>
        <?php endif; ?>

    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description" <?= isset($erreurs['description']) ? 'class="input-erreur"' : '' ?>"><?= isset($donnees['description']) ? htmlspecialchars($donnees['description']) : '' ?></textarea>
        <?php if(isset($erreurs['description'])): ?>
                <span class="erreur-texte"><?= $erreurs['description'] ?></span>
        <?php endif; ?>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>