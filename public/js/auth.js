function togglePasswordVisibilityRegister(number) {
    if (number === 1){
        var password = document.getElementsByName('Mot_de_passe')[0];
        var img = document.querySelector('.passimg');
    } else {
        var password = document.getElementsByName('Mot_de_passe_confirmation')[0];
        var img = document.querySelector('.passimg2');
    }
    if (password.type === 'password') {
        password.type = 'text';
        img.src = 'img/eye.svg';
    } else {
        password.type = 'password';
        img.src = 'img/eyeo.svg';
    }
}

function togglePasswordVisibilityLogin() {
    var password = document.getElementsByName('Mot_de_passe')[0];
    var img = document.querySelector('.passimg');
if (password.type === 'password') {
    password.type = 'text';
    img.src = 'img/eye.svg';
} else {
    password.type = 'password';
    img.src = 'img/eyeo.svg';
}
}


function validatePassword(password) {
const strongPasswordRegex = /^(?=.*[A-Z])(?=.*[@$!%*?&=])[A-Za-z\d@$!%*?&=]{12,}$/;
const errorMessage = document.getElementById('errorMessage');
// Check each condition and update the corresponding label
document.getElementById('minLength').innerHTML =
password.length >= 12 ?
'<span class="text-success">Minimum 12 caractères</span>' :
'<span class="text-danger">Minimum 12 caractères</span>';
document.getElementById('uppercase').innerHTML =
/[A-Z]/.test(password) ?
'<span class="text-success">Une lettre majuscule minimum</span>' :
'<span class="text-danger">Une lettre majuscule minimum</span>';
document.getElementById('symbol').innerHTML =
/[@$!%*?&=]/.test(password) ?
'<span class="text-success">Un symbole minimum (@$!%*?&=)</span>' :
'<span class="text-danger">Un symbole minimum (@$!%*?&=)</span>';
console.log(strongPasswordRegex.test(password))
// Check overall validity and update the error message
if (strongPasswordRegex.test(password)) {
    console.log("test")
errorMessage.textContent = 'Mot de passe fort';
errorMessage.classList.remove('text-danger');
errorMessage.classList.add('text-success');
} else {
errorMessage.textContent = 'Mot de passe trop faible';
errorMessage.classList.remove('text-success');
errorMessage.classList.add('text-danger');
}
}
