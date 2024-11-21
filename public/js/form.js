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
    const step2Div = document.getElementById('partenaire');
    const newdiv = document.createElement('div');
    newdiv.id = 'partner' + (parseInt(number) + 1);
    newdiv.className = 'm-3';
    newdiv.innerHTML = `

                                        <h2>Partenaire ${parseInt(number)+1}</h2>
                                        <div class='inputdiv'>
                                                <label class='form-label' for='nom${parseInt(number)+1}'>Nom</label>
                                                <input class='form-control' name='nom${parseInt(number)+1}' type='text' placeholder='Nom'>
                                        </div><br>
                                        <div>
                                                <label class='form-label' for='prenom${parseInt(number)+1}'>Prénom</label>
                                                <input class='form-control' name='prenom${parseInt(number)+1}' type='text' placeholder='Prénom'>
                                        </div><br>
                                        <div>
                                                <label class='form-label' for='email${parseInt(number)+1}'>Email</label>
                                                <input class='form-control' name='email${parseInt(number)+1}' type='text' placeholder='Email'>
                                        </div>

                        `;
    step2Div.appendChild(newdiv);
    step5 = document.getElementById('minsignature');
    step5.innerHTML = '';
    for (let i = 1; i <= parseInt(number)+1; i++) {
        step5.innerHTML += `
                        <option value="${i}">${i} partenaire minimum</option>
                        `;
    }

    const step3Div = document.getElementById('step3');
    const newdiv2 = document.createElement('div');
    newdiv2.id = 'partnercontrib' + parseInt(number) + 1;
    newdiv2.className = 'm-3 inputdiv';
    newdiv2.innerHTML = `
                                        <h2>Contribution ${parseInt(number)+1}</h2>
                                        <textarea class="form-control" name='contribution${parseInt(number)+1}' placeholder='Contribution'></textarea><br>
                               `;
    step3Div.appendChild(newdiv2);

}

function removepartie() {
    const number = document.getElementById('numberparties').value
    if (number > 1) {
        document.getElementById('numberparties').value = parseInt(number) - 1;
        document.getElementById('numberparties-span').innerHTML = parseInt(number) - 1;
        document.getElementById('partner' + number).remove();
        document.getElementById('partnercontrib' + number).remove();

    }
}



function included() {
    const partner = document.getElementById('partnerinclude')
    const partner1 = document.getElementById('partner1')
    const contribtitle1 = document.getElementById('contribtitle1')
    if (document.getElementById('include').checked) {
        partner.classList.remove('d-none')
        partner1.classList.add('d-none')
        contribtitle1.innerHTML = 'Ma contribution'

    } else {
        partner.classList.add('d-none')
        partner1.classList.remove('d-none')
        contribtitle1.innerHTML = 'Contribution 1'
    }





}


//Quand le dom est chargé
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


const form = document.getElementById('mainform');
form.addEventListener('submit', () => {
    const disabledInputs = form.querySelectorAll(':disabled');
    disabledInputs.forEach(input => input.disabled = false);
});


