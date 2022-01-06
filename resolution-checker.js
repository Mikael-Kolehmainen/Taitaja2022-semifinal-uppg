window.addEventListener('resize', function(event){
    var newWidth = window.innerWidth
    // var newHeight = window.innerHeight
    if (newWidth > 900) {
        changeLinksDisplay()
    }
    hideOrShowSlides()
});
function changeLinksDisplay() {
    links = document.getElementById('myLinks')

    links.style.display = 'block'
}
function showAllSlides() {
    slides = document.getElementsByClassName('mySlides')

    for (var i = 0; i < slides.length; i++) {
        slides[i].style.display = 'inline-block'
    }
}
function hideAllSlides() {
    slides = document.getElementsByClassName('mySlides')

    // i = 1 koska eka 'slide' pitää näkyä.
    for (var i = 1; i < slides.length; i++) {
        slides[i].style.display = 'none'
    }
}
function hideOrShowSlides() {
    var newWidth = window.innerWidth

    if (newWidth < 750) {
        showAllSlides()
    } else if (newWidth > 750) {
        hideAllSlides()
    }
}