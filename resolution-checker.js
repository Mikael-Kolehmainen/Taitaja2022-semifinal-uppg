window.addEventListener('resize', function(event){
    var newWidth = window.innerWidth;
    // var newHeight = window.innerHeight;
    if (newWidth > 900) {
        changeLinksDisplay()
    }
    if (newWidth < 750) {
        showAllSlides()
    }
});

function changeLinksDisplay() {
    links = document.getElementById('myLinks')

    links.style.display = 'block'
}

function showAllSlides() {
    slides = document.getElementsByClassName('mySlides')

    // loopa igenom alla slides o sätt display: block på alla
}