let menuToggle = false;

function changemode(mode) {
    if (mode === "light") {
            document.body.classList.remove("dark-theme");
            document.getElementById("mode-light").classList.remove("d-none");
            document.getElementById("mode-dark").classList.add("d-none");
            document.getElementById('userimg').src = 'img/user.png';
            document.getElementById('chevronimg').src = 'img/down-chevron.png';
    } else {
            document.body.classList.add("dark-theme");
            document.getElementById("mode-dark").classList.remove("d-none");
            document.getElementById("mode-light").classList.add("d-none");
            document.getElementById('userimg').src = 'img/userb.png';
            document.getElementById('chevronimg').src = 'img/down-chevronb.png';
    }
}

function showmenu() {
        let menu = document.getElementById('dropdownmenu');

        let chevron = document.getElementById('chevronimg');

        if (menuToggle) {
            menu.style.top = "-80px";
            chevron.style.transform = "rotate(-90deg)";
        } else {
            menu.style.top = "100px";
            chevron.style.transform = "rotate(00deg)";
        }
        menuToggle = !menuToggle;
}
