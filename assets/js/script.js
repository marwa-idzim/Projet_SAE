/* =========================================================
   SCRIPT DU MENU DE NAVIGATION
   =========================================================
   Ce JavaScript sert uniquement à déplacer le petit trait coloré
   sous l'élément actif du menu.

   Important :
   - Le site marche même sans ce JavaScript.
   - Le PHP indique déjà la page active avec la classe is-active.
   - Le JS rend juste l'effet visuel plus joli.
*/

// On récupère le trait coloré sous le menu.
const indicator = document.querySelector('.nav-indicator');

// On récupère tous les liens du menu.
const items = document.querySelectorAll('.nav-item');

// Cette fonction place l'indicateur sous le lien actif.
function handleIndicator(el) {
    // Si l'indicateur ou le lien n'existe pas, on arrête la fonction.
    // Ça évite les erreurs JavaScript sur une page qui n'aurait pas le menu.
    if (!indicator || !el) {
        return;
    }

    // On enlève le style actif de tous les liens.
    items.forEach(item => {
        item.classList.remove('is-active');
        item.removeAttribute('style');
    });

    // On récupère la couleur définie dans le HTML : data-active-color.
    // Si elle n'existe pas, on utilise une couleur bleue par défaut.
    const elementColor = el.dataset.activeColor || '#2563eb';

    // On donne à l'indicateur la même largeur que le lien.
    indicator.style.width = `${el.offsetWidth}px`;

    // On déplace l'indicateur sous le lien.
    indicator.style.left = `${el.offsetLeft}px`;

    // On colore l'indicateur avec la couleur du lien.
    indicator.style.backgroundColor = elementColor;

    // On marque ce lien comme actif.
    el.classList.add('is-active');

    // On colore le texte du lien actif.
    el.style.color = elementColor;
}

// On ajoute l'effet de clic sur chaque lien du menu.
items.forEach(item => {
    item.addEventListener('click', event => {
        handleIndicator(event.currentTarget);
    });
});

// Quand la page se charge, on place directement l'indicateur
// sous le lien qui a déjà la classe is-active.
const activeItem = document.querySelector('.nav-item.is-active');
handleIndicator(activeItem);

// Si l'utilisateur redimensionne la fenêtre, la position du lien peut changer.
// Donc on replace l'indicateur au bon endroit.
window.addEventListener('resize', () => {
    const currentActiveItem = document.querySelector('.nav-item.is-active');
    handleIndicator(currentActiveItem);
});
