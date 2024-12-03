/**
 * Nom du fichier : form.js
 * Description    : Fichier de script de la page de creation de contrat
 * Auteur         : Hugo Jeanselme
 *
 * Utilisation :
 * - Generation et gestion de la barre de progression
 * - Gestion de la navigation entre les étapes
 * - Reactivation des champs désactivés avant la soumission du formulaire
 *
*/



// Variables globales necessaires pour la gestion de la barre de progression et de la navigation

currentStep= 1
steeperLeftDist = 0


// Fonction permettant de passer a l'etape suivante

function nextStep() {

    // Verifie qu'il n'y a pas de depassement du nombre d'etapes

    if (currentStep< 6) {

        // Recuperation des elements necessaires

        let nextButton = document.getElementById("buttonsuivant")

        let currentStepper = document.getElementById("stepper" + currentStep)

        let progressBar = document.getElementById("mainStepper")

        let currentStepSeparator = document.getElementById("stepSeparator" + currentStep);


        // Desactivation du bouton suivant pendant l'animation pour laisser le temps a l'animation de se terminé

        nextButton.disabled = true;


        // Deplacement de la barre de progression vers la droite

        steeperLeftDist += 145;

        progressBar.style.left = steeperLeftDist + "px";


        // Mis a jour de la couleur des étapes de la barre de progression

        currentStepper.classList.remove("step__circle-inactive");
        currentStepper.classList.add("step__circle-done");


        // Cache l'étape actuelle et affiche l'étape suivante

        document.getElementById('step'+currentStep).classList.add('d-none');
        document.getElementById('step'+(currentStep+1)).classList.remove('d-none');


        // Change la couleur du separateur entre les étapes en vert

        currentStepSeparator.firstChild.classList.add("w-100");


        // Verifie si l'etape actuelle est la derniere etape et met le bouton de soumission du formulaire

        if (currentStep=== 5) {
            let submitButton = document.getElementById("buttonsubmit")

            nextButton.classList.add("d-none")
            submitButton.classList.remove("d-none")
        }


        // Permet de re-activer le bouton suivant apres l'animation

        setTimeout(() => {
            nextButton.disabled = false;
          }, 800);


        // Incrementation de l'etape actuelle

        currentStep++;

    }

}


// Fonction permettant de revenir à l'étape précédente

function previousStep() {

    // Vérifie qu'il n'y a pas de dépassement inférieur au nombre d'étapes minimum

    if (currentStep > 1) {

        // Récupération des éléments nécessaires

        let previousButton = document.getElementById("buttonprev");

        let currentStepper = document.getElementById("stepper" + currentStep);

        let progressBar = document.getElementById("mainStepper");

        let previousStepSeparator = document.getElementById("stepSeparator" + (currentStep - 1));


        // Desactivation du bouton precedent pendant l'animation pour laisser le temps a l'animation de se terminé

        previousButton.disabled = true;


        // Déplacement de la barre de progression vers la gauche

        steeperLeftDist -= 145;

        progressBar.style.left = steeperLeftDist + "px";


        // Mis a jour de la couleur des étapes de la barre de progression

        currentStepper.classList.remove("step__circle-done");

        currentStepper.classList.add("step__circle-inactive");


        // Mise à jour du séparateur précédent pour lui retirer la couleur verte

        previousStepSeparator.firstChild.classList.remove("w-100");


        // Cache l'étape actuelle et affiche l'étape précédente

        document.getElementById('step' + currentStep).classList.add('d-none');

        document.getElementById('step' + (currentStep - 1)).classList.remove('d-none');


        // Vérifie si l'étape actuelle était la dernière étape et réaffiche le bouton "Suivant"

        if (currentStep === 6) {

            let nextButton = document.getElementById("buttonSuivant");

            let submitButton = document.getElementById("buttonSubmit");


            nextButton.classList.remove("d-none");

            submitButton.classList.add("d-none");

        }


        // Permet de re-activer le bouton precedent apres l'animation

        setTimeout(() => {
            previousButton.disabled = false;
        }, 800);


        // Décrémentation de l'étape actuelle

        currentStep--;
    }
}



// Permet de generer la barre de progression
// Quand le dom est chargé

document.addEventListener('DOMContentLoaded', function () {

    const elements = [
        "Noms",
        "Activités",
        "Contributions",
        "Modalités",
        "Durée",
        "Infos"
    ];


    // Recuperation de la div contenant la barre de progression et ajout du premier rond de progression ainsi que du rond mobile

    stepper = document.getElementById('stepper');

    stepper.innerHTML = `
            <div class="step">
                <div class="step__circle-large centered" id="stepper1">
                    <div id='mainStepper' class="step__main step__circle-large step__circle-active position-relative centered" id="stepper1">
                        <div class="step__circle-small step__circle-small-active">
                        </div>
                    </div>
                </div>
                <span class="step__title">${elements[0]}</span>
            </div>
        `;


    // Ajout des autres etapes de la barre de progression (separateur et rond)

    for (let i = 1; i < elements.length; i++) {
        stepper.innerHTML += `
                        <div id="stepSeparator${i}" class="step__sep step__sep-inactive"><div class="w-0 h-100 step__sep-done"></div></div>
                        <div class="step">
                                <div class="step__circle-large step__circle-inactive centered" id="stepper${i + 1}"></div>
                                <span class="step__title">${elements[i]}</span>
                        </div>
                `;
    }

});



// Permet de re-activer les champs desactivés avant la soumission du formulaire

const form = document.getElementById('mainForm');
form.addEventListener('submit', () => {
    const disabledInputs = form.querySelectorAll(':disabled');
    disabledInputs.forEach(input => input.disabled = false);
});


