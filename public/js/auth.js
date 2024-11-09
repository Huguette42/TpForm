function togglePasswordVisibilityRegister(number) {
    if (number === 1){
        var password = document.getElementsByName('password')[0];
        var img = document.querySelector('.passimg');
    } else {
        var password = document.getElementsByName('password2')[0];
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
    var password = document.getElementsByName('password')[0];
    var img = document.querySelector('.passimg');
if (password.type === 'password') {
    password.type = 'text';
    img.src = 'img/eye.svg';
} else {
    password.type = 'password';
    img.src = 'img/eyeo.svg';
}
}
