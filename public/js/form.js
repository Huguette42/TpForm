step = 1



function nextstep() {
    if (step < 6) {
        document.getElementById("step" + step).classList.add("d-none");
        document.getElementById("step" + (step + 1)).classList.remove("d-none");

        let stepper1 = document.getElementById("stepper" + step)
        let stepper2 = document.getElementById("stepper" + (step + 1))

        let stepsep1 = document.getElementById("stepsep" + step);

        stepper1.children[0].classList.remove("step-circle-active2");
        stepper1.classList.remove("step-circle-active");
        stepper1.classList.add("step-circle-done");

        stepper2.classList.remove("step-circle-inactive");
        stepper2.classList.add("step-circle-active");
        stepper2.children[0].classList.add("step-circle-active2");

        stepsep1.classList.add("step-sep-done");
        stepsep1.classList.remove("step-sep-inactive");

        if (step === 5) {
            let suivbtn = document.getElementById("buttonsuivant")
            let validbtn = document.getElementById("buttonsubmit")

            suivbtn.classList.add("d-none")
            validbtn.classList.remove("d-none")
        }
        step++;
    }

}

function prevstep() {
    if (step > 1) {
        document.getElementById("step" + step).classList.add("d-none");
        document.getElementById("step" + (step - 1)).classList.remove("d-none");

        let stepper1 = document.getElementById("stepper" + step)
        let stepper2 = document.getElementById("stepper" + (step - 1))

        let stepsep1 = document.getElementById("stepsep" + (step - 1));

        stepper1.children[0].classList.remove("step-circle-active2");
        stepper1.classList.remove("step-circle-active");
        stepper1.classList.add("step-circle-inactive");

        stepper2.classList.remove("step-circle-done");
        stepper2.classList.add("step-circle-active");
        stepper2.children[0].classList.add("step-circle-active2");

        stepsep1.classList.add("step-sep-inactive");
        stepsep1.classList.remove("step-sep-done");

        if (step === 6) {
            let suivbtn = document.getElementById("buttonsuivant")
            let validbtn = document.getElementById("buttonsubmit")

            suivbtn.classList.remove("d-none")
            validbtn.classList.add("d-none")
        }

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
                <div class="step-circle-large step-circle-active centered" id="stepper1">
                    <div class="step-circle-small step-circle-active2">
                    </div>
                    <div class="step-circle-small position-relative step-circle-active2">
                    </div>
                </div>
                <span class="step-title">${elements[0]}</span>
            </div>
        `;

    for (let i = 1; i < elements.length; i++) {
        stepper.innerHTML += `
                        <div id="stepsep${i}" class="step-sep step-sep-inactive"></div>
                        <div class="step">
                                <div class="step-circle-large step-circle-inactive centered" id="stepper${i + 1}"><div class="step-circle-small"></div></div>
                                <span class="step-title">${elements[i]}</span>
                        </div>
                `;
    }

});
