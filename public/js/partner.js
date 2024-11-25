function updateFormsWithSelectedPartners(partnerId, isChecked) {
    const hiddenInputs = document.getElementsByClassName('selected_partner_hidden');

    for (let i = 0; i < hiddenInputs.length; i++) {
        // Récupère la liste actuelle sous forme de tableau
        let selectedPartners = [];
        if (hiddenInputs[i].value == "vide") {
            selectedPartners = [];
        } else {
            selectedPartners = hiddenInputs[i].value.split(',').map(Number);
        }

        if (isChecked) {
            // Ajouter l'ID si non présent
            if (!selectedPartners.includes(partnerId)) {
                selectedPartners.push(partnerId);
            }
        } else {
            // Retirer l'ID si présent
            selectedPartners = selectedPartners.filter(id => id !== partnerId);
        }

        // Met à jour la valeur de l'input
        hiddenInputs[i].value = selectedPartners.join(',');
    };
}

function checkbox_change(checkbox) {
    const partnerId = parseInt(checkbox.value); // Récupère l'ID du partenaire
    const isChecked = checkbox.checked; // Vérifie si la case est cochée
    updateFormsWithSelectedPartners(partnerId, isChecked);
}

function reset_partner() {
    const hiddenInputs = document.getElementsByClassName('selected_partner_hidden');
    for (let i = 0; i < hiddenInputs.length; i++) {
        hiddenInputs[i].value = "vide";
    }
    refresh_checkbox();
}

// Attachez des événements aux cases à cocher lorsque le DOM est chargé
document.addEventListener('DOMContentLoaded', function () {
    refresh_checkbox();
});


function refresh_checkbox() {
    const checkboxes = document.getElementsByClassName('partner_checkbox');

    // Pré-cocher les cases basées sur l'input caché
    const hiddenInput = document.getElementById('selectedPartnersInput');
    let selectedPartners = [];
    if (hiddenInput.value == "vide") {
        selectedPartners = [];
    } else {
        selectedPartners = hiddenInput.value.split(',').map(Number);
    }


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
