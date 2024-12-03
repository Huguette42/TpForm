/**
 * Nom du fichier : auth.js
 * Description    : Fichier de script de la page register et login
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Fonction pour afficher ou cacher le mot de passe
 * - Fonction pour valider la robustesse du mot de passe
 *
*/


// Fonction pour afficher ou cacher le mot de passe de la page register

function togglePasswordVisibility(number) {

    // Recupere le mot de passe et l'image de l'oeil correspondant

    if (number === 1) {

        var password = document.getElementsByName('Mot_de_passe')[0];

        var img = document.querySelector('.passimg');

    } else {

        var password = document.getElementsByName('Mot_de_passe_confirmation')[0];

        var img = document.querySelector('.passimg2');

    }

    // Change l'image de l'oeil et le type du mot de passe

    if (password.type === 'password') {

        password.type = 'text';

        img.src = 'img/eye.svg';

    } else {

        password.type = 'password';

        img.src = 'img/eyeo.svg';

    }
}


// Fonction pour valider la robustesse du mot de passe

function validatePassword(password) {

    // Expression reguliere pour un mot de passe fort

    const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[@$!%*?&=])[A-Za-z\d@$!%*?&=]{12,}$/;

    // Recupere l'element d'affichage des erreurs

    const errorMessage = document.getElementById('errorMessage');


    // Affiche les erreurs en rouge ou vert en fonction des critères

    document.getElementById('minLength').innerHTML = password.length >= 12 ?

                                                    '<span class="text-success">Minimum 12 caractères</span>' :

                                                    '<span class="text-danger">Minimum 12 caractères</span>';

    document.getElementById('uppercase').innerHTML = /[A-Z]/.test(password) ?

                                                    '<span class="text-success">Une lettre majuscule minimum</span>' :

                                                    '<span class="text-danger">Une lettre majuscule minimum</span>';

    document.getElementById('symbol').innerHTML = /[@$!%*?&=]/.test(password) ?

                                                   '<span class="text-success">Un symbole minimum (@$!%*?&=)</span>' :

                                                   '<span class="text-danger">Un symbole minimum (@$!%*?&=)</span>';


    // Verifie si le mot de passe est fort ou faible et affiche le message correspondant

    if (strongPasswordRegex.test(password)) {

        errorMessage.textContent = 'Mot de passe fort';

        errorMessage.classList.remove('text-danger');

        errorMessage.classList.add('text-success');

    } else {

        errorMessage.textContent = 'Mot de passe trop faible';

        errorMessage.classList.remove('text-success');

        errorMessage.classList.add('text-danger');

    }
}
