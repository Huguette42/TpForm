step = 1
steppermainLeft = 0


function nextstep() {
    if (step < 6) {
        let suivbtn = document.getElementById("buttonsuivant")
        suivbtn.disabled = true;

        let stepper1 = document.getElementById("stepper" + step)

        let mainstepper = document.getElementById("mainstepper")

        let stepsep1 = document.getElementById("stepsep" + step);

        steppermainLeft = steppermainLeft+145

        mainstepper.style.left = steppermainLeft + "px";

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

function addpartie() {
    const number = document.getElementById('numberparties').value
    document.getElementById('numberparties').value = parseInt(number) + 1;
    document.getElementById('numberparties-span').innerHTML = parseInt(number) + 1;
    refreshpartenaire();
}

function removepartie() {
    const number = document.getElementById('numberparties').value
    if (number > 1) {
        document.getElementById('numberparties').value = parseInt(number) - 1;
        document.getElementById('numberparties-span').innerHTML = parseInt(number) - 1;
        refreshpartenaire();
    }
}


function refreshpartenaire() {
    const number = document.getElementById('numberparties').value
    const step2Div = document.getElementById('partenaire');
    step2Div.innerHTML = '';

    for (let i = 1; i <= number; i++) {
        step2Div.innerHTML += `
                                <div class="m-5">
                                        <h2>Partenaire ${i}</h2>
                                        <div>
                                                <label class='form-label' for='nom${i}'>Nom</label>
                                                <input class='form-control' name='nom${i}' type='text' placeholder='Nom'>
                                        </div><br>
                                        <div>
                                                <label class='form-label' for='prenom${i}'>Prénom</label>
                                                <input class='form-control' name='prenom${i}' type='text' placeholder='Prénom'>
                                        </div>
                                </div>
                        `;
    }

    step3 = document.getElementById('step3');
    step3.innerHTML = '';

    for (let i = 1; i <= number; i++) {
        step3.innerHTML += `
                                <div class="m-5">
                                        <h2>Partenaire ${i}</h2>
                                        <textarea class="form-control" name='contribution${i}' placeholder='Contribution'></textarea><br>
                                </div>
                        `;
    }

    step5 = document.getElementById('minsignature');
    step5.innerHTML = '';

    for (let i = 1; i <= number; i++) {
        step5.innerHTML += `
                        <option value="${i}">${i} partenaire minimum</option>
                        `;
    }
}


//Quand le dom est chargé
document.addEventListener('DOMContentLoaded', function () {
    refreshpartenaire();
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
