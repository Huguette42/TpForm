function changemode(mode) {
    if (mode === "light") {
            document.body.classList.remove("dark-theme");
            document.getElementById("mode-light").classList.remove("d-none");
            document.getElementById("mode-dark").classList.add("d-none");
            document.getElementById('userimg').src = 'img/user.png';
    } else {
            document.body.classList.add("dark-theme");
            document.getElementById("mode-dark").classList.remove("d-none");
            document.getElementById("mode-light").classList.add("d-none");
            document.getElementById('userimg').src = 'img/userb.png';
    }
}
