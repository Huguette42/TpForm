/**
 * Nom du fichier : header.js
 * Description    : Fichier de script du header
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Affichage du menu deroulant
 * - Changement du mode de couleur(clair/sombre)
 *
*/


// Permet de changer l'affichage avec le mode voulu : clair/sombre

function changemode(mode) {

    if (mode === "light") {

        // Enleve la class qui change les variable de couleur css en sombre

        document.body.classList.remove("dark-theme");

        // Changement du logo lune/soleil
        document.getElementById("mode-light").classList.remove("d-none");
        document.getElementById("mode-dark").classList.add("d-none");

        // Changement de couleur des images du header

        document.getElementById('userimg').src = 'img/user.png';
        document.getElementById('chevronimg').src = 'img/down-chevron.png';

        // Enregistrement de l'etat du mode pour le rendre resistant au changement de page

        localStorage.setItem('theme', mode)

    } else {

        document.body.classList.add("dark-theme");

        document.getElementById("mode-dark").classList.remove("d-none");
        document.getElementById("mode-light").classList.add("d-none");

        document.getElementById('userimg').src = 'img/userb.png';
        document.getElementById('chevronimg').src = 'img/down-chevronb.png';

        localStorage.setItem('theme', mode)

    }
    
}


// Variable qui stocke l'état du menu déroulant

let menuToggle = false;

function showmenu() {

    // Récuperation des elements

    let menu = document.getElementById('dropdownmenu');

    let chevron = document.getElementById('chevronimg');


    // Rotation du chevron et deplacement du menu

    if (menuToggle) {

        menu.style.top = "-80px";

        chevron.style.transform = "rotate(-90deg)";

    } else {

        menu.style.top = "100px";

        chevron.style.transform = "rotate(00deg)";

    }

    // Change l'etat du menu

    menuToggle = !menuToggle;
}


// Permet au demarage de mettre le thème enregistrer

document.addEventListener('DOMContentLoaded', function () {

    // Si un thème est deja séléctionne cela l'applique

    if (localStorage.getItem('theme') !== null) {

        changemode(localStorage.getItem('theme'))

    }

});

