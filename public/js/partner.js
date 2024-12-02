/**
 * Nom du fichier : partner.js
 * Description    : Fichier de script de la page de choix de partenaires
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Permet de gérer les cases à cocher des partenaires
 * - Permet de mettre à jour les formulaires cachés avec les partenaires sélectionnés
 *
*/


// Fonction pour mettre à jour les formulaires cachés avec les partenaires sélectionnés

function updateFormsWithSelectedPartners(partnerId, isChecked) {

    // Récupère tous les inputs cachés

    const hiddenInputs = document.getElementsByClassName('selected_partner_hidden');

    // Parcours tous les inputs cachés

    for (let i = 0; i < hiddenInputs.length; i++) {

        // Récupère la liste actuelle des partenaire sous forme de tableau

        let selectedPartners = [];

        if (hiddenInputs[i].value == "vide") {

            selectedPartners = [];

        } else {

            selectedPartners = hiddenInputs[i].value.split(',').map(Number);

        }

        // Verifie si le partenaire doit être ajouté ou retiré

        // Il est ensuite ajouté ou enleevr de la liste

        if (isChecked) {

            if (!selectedPartners.includes(partnerId)) {

                selectedPartners.push(partnerId);

            }

        } else {

            selectedPartners = selectedPartners.filter(id => id !== partnerId);

        }

        // Met à jour la valeur de l'input

        hiddenInputs[i].value = selectedPartners.join(',');
    };

    // Met a jour le compteur de partenaires sélectionnés

    document.getElementById('numberpartnerselect').innerHTML =  "Vous avez séléctionné " + hiddenInputs[0].value.split(',').map(Number).length + " partenaire(s)";
}


// Fonction executé par les checkboxs

function checkbox_change(checkbox) {

    const partnerId = parseInt(checkbox.value);

    const isChecked = checkbox.checked;

    updateFormsWithSelectedPartners(partnerId, isChecked);

}


// Fonction pour vider les partenaires sélectionnés

function reset_partner() {

    const hiddenInputs = document.getElementsByClassName('selected_partner_hidden');

    for (let i = 0; i < hiddenInputs.length; i++) {

        hiddenInputs[i].value = "vide";

    }

    refresh_checkbox();

}

// Cocher les case deja séléctionnées lorsque la pages est chargée

document.addEventListener('DOMContentLoaded', function () {

    refresh_checkbox();

});


// Fonction qui coche les cases qui sont dans les inputs cachés

function refresh_checkbox() {

    // Récupère toute les checkboxs ainsi

    const checkboxes = document.getElementsByClassName('partner_checkbox');

    const hiddenInput = document.getElementById('selectedPartnersInput');


    // Récupère la liste actuelle des partenaire sous forme de tableau

    let selectedPartners = [];

    if (hiddenInput.value == "vide") {

        selectedPartners = [];

    } else {

        selectedPartners = hiddenInput.value.split(',').map(Number);

    }


    // Met à jour le texte du compteur de partenaires sélectionnés

    document.getElementById('numberpartnerselect').innerHTML =  "Vous avez séléctionné " + selectedPartners.length + " partenaire(s)";


    // Parcours tous les checkboxs et coche ceux qui sont dans la liste

    for (let i = 0; i < checkboxes.length; i++) {

        const checkbox = checkboxes[i];

        const partnerId = parseInt(checkbox.value);

        if (selectedPartners.includes(partnerId)) {

            checkbox.checked = true;

        } else {

            checkbox.checked = false;

        }
    }
}
