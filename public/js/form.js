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

step = 1
steppermainLeft = 0


// Fonction permettant de passer a l'etape suivante

function nextstep() {

    // Verifie qu'il n'y a pas de depassement du nombre d'etapes

    if (step < 6) {

        // Recuperation des elements necessaires

        let suivbtn = document.getElementById("buttonsuivant")

        let stepper1 = document.getElementById("stepper" + step)

        let mainstepper = document.getElementById("mainstepper")

        let stepsep1 = document.getElementById("stepsep" + step);


        // Desactivation du bouton suivant pendant l'animation pour laisser le temps a l'animation de se terminé

        suivbtn.disabled = true;




        mainstepper.style.left = (steppermainLeft+145) + "px";

        stepper1.classList.remove("step-circle-inactive");
        stepper1.classList.add("step-circle-done");

        document.getElementById('step'+step).classList.add('d-none');
        document.getElementById('step'+(step+1)).classList.remove('d-none');

        stepsep1.firstChild.classList.add("w-100");

        if (step === 5) {
            let validbtn = document.getElementById("buttonsubmit")

            suivbtn.classList.add("d-none")
            validbtn.classList.remove("d-none")
        }
        setTimeout(() => {
            suivbtn.disabled = false;
          }, 800);
        step++;
    }

}


// Fonction permettant de revenir a l'etape precedente

function prevstep() {
    if (step > 1) {
        let prevbtn = document.getElementById("buttonprev")
        prevbtn.disabled = true;

        let stepper1 = document.getElementById("stepper" + step)

        let mainstepper = document.getElementById("mainstepper")

        let stepsep1 = document.getElementById("stepsep" + (step - 1));

        steppermainLeft = steppermainLeft-145

        mainstepper.style.left = steppermainLeft + "px";

        // Mis a jour du stepper Actuel
        stepper1.classList.remove("step-circle-active");
        stepper1.classList.add("step-circle-inactive");

        // Mis a jour du separateur precedent
        stepsep1.firstChild.classList.remove("w-100");

        document.getElementById('step'+step).classList.add('d-none');
        document.getElementById('step'+(step-1)).classList.remove('d-none');

        if (step === 6) {
            let suivbtn = document.getElementById("buttonsuivant")
            let validbtn = document.getElementById("buttonsubmit")

            suivbtn.classList.remove("d-none")
            validbtn.classList.add("d-none")
        }
        setTimeout(() => {
            prevbtn.disabled = false;
          }, 800);
        step--;
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

    stepper = document.getElementById('stepper');

    stepper.innerHTML = `
            <div class="step">
                <div class="step-circle-large centered" id="stepper1">
                    <div id='mainstepper' class="step-circle-large step-circle-active position-relative centered" id="stepper1">
                        <div class="step-circle-small step-circle-active2">
                        </div>
                    </div>
                </div>
                <span class="step-title">${elements[0]}</span>
            </div>
        `;

    for (let i = 1; i < elements.length; i++) {
        stepper.innerHTML += `
                        <div id="stepsep${i}" class="step-sep step-sep-inactive"><div class="w-0 h-100 step-sep-done"></div></div>
                        <div class="step">
                                <div class="step-circle-large step-circle-inactive centered" id="stepper${i + 1}"></div>
                                <span class="step-title">${elements[i]}</span>
                        </div>
                `;
    }

});



// Permet de re-activer les champs desactivés avant la soumission du formulaire

const form = document.getElementById('mainform');
form.addEventListener('submit', () => {
    const disabledInputs = form.querySelectorAll(':disabled');
    disabledInputs.forEach(input => input.disabled = false);
});


