/* =========================================================
   SCRIPT DU BOUTON "S'INSCRIRE"
   =========================================================
   Ce fichier sert à rendre les boutons des séances cliquables.
   Quand on clique sur "S'inscrire", on récupère l'id de la séance
   puis on redirige vers la page ajouter_inscriptions.php.
*/

// On attend que le document soit chargé avant de chercher les boutons.
$(document).ready(function () {
    // On écoute le clic sur tous les boutons qui ont la classe btn-inscription.
    $('.btn-inscription').on('click', function () {
        // data-id-seance dans le HTML devient idSeance en jQuery.
        const idSeance = $(this).data('id-seance');

        // Si l'id existe, on redirige vers la page d'inscription.
        if (idSeance) {
            window.location.href = 'ajouter_inscriptions.php?id_seance=' + idSeance;
        }
    });
});
