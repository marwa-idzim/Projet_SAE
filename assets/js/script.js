// On récupère l'élément qui sert d'indicateur sous le menu
const indicator = document.querySelector('.nav-indicator');

// On récupère tous les liens du menu qui ont la classe "nav-item"
const items = document.querySelectorAll('.nav-item');

// Cette fonction déplace et colore l'indicateur
// selon l'élément du menu sur lequel on clique
function handleIndicator(el) {

    items.forEach(item => {
        // On enlève la classe "is-active" de tous les liens
        // Comme ça, un seul lien peut être actif à la fois
        item.classList.remove('is-active');

        // On enlève le style ajouté directement en JavaScript
        // Par exemple la couleur du texte
        item.removeAttribute('style');
    });


    // On récupère la couleur stockée dans l'attribut data-active-color
    // Exemple : data-active-color="#cc0000"
    const elementColor = el.dataset.activeColor;

    // On récupère la valeur stockée dans data-target
    const target = el.dataset.target;


    // On donne à l'indicateur la même largeur que le lien cliqué
    indicator.style.width = `${el.offsetWidth}px`;

    // On donne à l'indicateur la couleur du lien cliqué
    indicator.style.backgroundColor = elementColor;

    // On déplace l'indicateur horizontalement
    // pour qu'il soit placé sous le lien cliqué
    indicator.style.left = `${el.offsetLeft}px`;


    // On ajoute la classe "is-active" au lien cliqué
    // Ça permet de savoir quel lien est actuellement sélectionné
    el.classList.add('is-active');

    // On change la couleur du texte du lien actif
    el.style.color = elementColor;
}


items.forEach((item) => {
    item.addEventListener('click', e => {
        // On appelle la fonction pour déplacer l'indicateur
        // e.target représente l'élément sur lequel on a cliqué
        handleIndicator(e.target);
    });

    // Au chargement de la page :
    // si un lien a déjà la classe "is-active",
    // alors on place directement l'indicateur sous ce lien
    if (item.classList.contains('is-active')) {
        handleIndicator(item);
    }
});