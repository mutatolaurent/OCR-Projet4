// script JS chargé à l'affichage du formulaire d'ajout d'une nouvelle oeuvre (ajouter.php)
// Objectif :
// Vérifier que les informations saisies dans les champs du formulaire sont conformes aux données attendues.
// Si au moins un champ n'est pas conforme, le script bloque le transfert des informations vers le script PHP chargé de les intégrer à la BD
//
document.addEventListener("DOMContentLoaded", function () {
  // On cible le formulaire de la page courante
  const form = document.querySelector("form");
  // console.log("start ...");

  // On attend un clic sur le bouton de soumission du formulaire
  form.addEventListener("submit", function (event) {
    let isValid = true;
    // console.log("submit ...");

    // Fonction chargée d'afficher un message d'erreur sous le champ en erreur
    function showError(input, message) {
      isValid = false;

      // Ajout de la classe CSS qui change le style de la bordure du champ en erreur
      input.classList.add("input-erreur");

      // Ajout d'une balise span avec le message d'erreur sous le champ en erreur
      let span = input.parentElement.querySelector(".erreur-texte");
      if (!span) {
        span = document.createElement("span");
        span.classList.add("erreur-texte");
        input.parentElement.appendChild(span);
      }
      span.textContent = message;
    }

    // Fonction chargée d'effacer les messages d'erreurs et de supprimer les styles d'erreurs
    function clearError(input) {
      input.classList.remove("input-erreur");
      const span = input.parentElement.querySelector(".erreur-texte");
      if (span) span.remove();
    }

    // Récupération des champs
    const titre = document.getElementById("titre");
    const artiste = document.getElementById("artiste");
    const image = document.getElementById("image");
    const description = document.getElementById("description");

    // Nettoyage des erreurs précédentes
    [titre, artiste, image, description].forEach(clearError);

    // --- VALIDATIONS ---

    // 1) Titre : non vide
    if (titre.value.trim() === "") {
      showError(titre, "Le titre ne peut pas être vide.");
    }

    // 2) Artiste: non vide
    if (artiste.value.trim() === "") {
      showError(artiste, "L'artiste ne peut pas être vide.");
    }

    // 3) Image : non vide + structure URL + extension image + existence réelle
    const imageValue = image.value.trim();

    if (imageValue === "") {
      showError(image, "L'URL de l'image ne peut pas être vide.");
    } else {
      // regex qui vérifie que l'URL de l'image est bien formée:
      // - ^https?:\/\/ => commence par http:// ou https://
      // - ([a-zA-Z0-9-]+\.)+
      //   [a-zA-Z0-9-]+ => un groupe de caractères valides pour un nom de domaine
      //   \. => suivi d'un point
      //   + => répété au moins une fois
      // - [a-zA-Z]{2,} => C’est l’extension du domaine avec au moins 2 caractères
      // - (\/.*)? => OPtionnel : un / suivi de n'importe quoi, c'est le ? qui rend tout çà optionnel
      const urlStructureRegex =
        /^https?:\/\/([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?$/;

      // regex qui vérifie que l'extension du fichier de l'iamge correspond à un des formats attendus
      const imageExtensionRegex = /\.(jpg|jpeg|png|gif|webp)$/i;

      // Test 1 : structure URL
      if (!urlStructureRegex.test(imageValue)) {
        showError(
          image,
          "L'URL n'est pas conforme (http(s) + nom de domaine valide).",
        );
      }

      // Test 2 : extension image
      else if (!imageExtensionRegex.test(imageValue)) {
        showError(
          image,
          "L'URL ne pointe pas vers une image (.jpg, .png, .gif, .webp).",
        );
      }
    }

    /*
    // 3) Image : non vide + URL valide + extension image
    const imageValue = image.value.trim();

    if (imageValue === "") {
      showError(image, "L'URL de l'image ne peut pas être vide.");
    } else {
      // regex qui vérifie que l'URL de l'image :
      // - ^https?:\/\/ => commence par http:// ou https://
      // - ([a-zA-Z0-9-]+\.)+
      //   [a-zA-Z0-9-]+ => un groupe de caractères valides pour un nom de domaine
      //   \. => suivi d'un point
      //   + => répété au moins une fois
      // - [a-zA-Z]{2,} => C’est l’extension du domaine avec au moins 2 caractères
      // - (\/.*)? => OPtionnel : un / suivi de n'importe quoi, c'est le ? qui rend tout çà optionnel
      // - \.(jpg|jpeg|png|gif|webp) => contient un point suivi de jpg, jpeg, png, gif ou webp
      // - $ => ne contient rien après cette extension (sous entendu pas de query string)
      // - i => insensitive = insensible à la casse (JPG = jpg)”
      // const imageRegex = /^https?:\/\/.+\.(jpg|jpeg|png|gif|webp)$/i;
      const imageRegex =
        /^https?:\/\/([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,}(\/.*)?\.(jpg|jpeg|png|gif|webp)$/i;

      try {
        // new URL(imageValue); // Vérifie la structure générale
        if (!imageRegex.test(imageValue)) {
          showError(
            image,
            "L'URL doit pointer vers une image (.jpg, .png, .gif, .webp).",
          );
        }
      } catch {
        showError(image, "L'URL n'est pas valide.");
      }
    }
*/
    // 4) Description : non vide + longueur >= 3
    if (description.value.trim().length < 3) {
      showError(
        description,
        "La description doit contenir au moins 3 caractères.",
      );
    }

    // Si une erreur existe → empêcher l’envoi du formaulaire
    if (!isValid) {
      event.preventDefault();
    }
  });
});
