function checkRes() {
    if (window.innerWidth <= 900) {
        // hamburger menu
        var hamburgerMenu = document.getElementById("hamburger")

        hamburgerMenu.innerHTML = `
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <img src="img/menu-bars.png">
            </a>
        `
        // slideshow
        var buttons = document.getElementById("buttons")
        var dots = document.getElementById("dots")

        buttons.innerHTML = ''
        dots.innerHTML = ''
    }
}