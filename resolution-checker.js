var oldWidth
window.onload = function WindowLoad(event) {
    oldWidth = window.innerWidth
    console.log(oldWidth)
}
window.addEventListener('resize', function(event){
    var newWidth = window.innerWidth
    // var newHeight = window.innerHeight
    console.log('New: ' + newWidth)
    console.log('Old: ' + oldWidth)
    if (newWidth > 900) {
        changeLinksDisplay()
    }
    if (newWidth < 750 && newWidth > oldWidth) {
        console.log('lol')
        changeHeight('increased')
    } else if (newWidth < 750 && newWidth < oldWidth) {
        changeHeight('decreased')
    }
    hideOrShowSlides()
    var oldWidth = newWidth
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
    var newWidth = window.innerWidth;

    if (newWidth < 750) {
        showAllSlides()
    } else if (newWidth > 750) {
        hideAllSlides()
    }
}
// Vaihtaa slideshow tekstien pituuden jotta kaikki ovat saman pituisia. 
function changeHeight(screenWidth) {
    texts = document.getElementsByClassName('text')
    let height = []
    for (i = 0; i < texts.length; i++) {
        height.push(texts[i].offsetHeight)
    }
    if (screenWidth == 'decreased') {
        var index = height.indexOf(Math.max.apply(Math, height))
        // Lisää pisin pituus kaikkiin paitsi pisimpään.
        for (j = 0; j < texts.length; j++) {
            texts[j].style.height = Math.max.apply(Math, height) + "px"
        }
    } else if (screenWidth == 'increased') {
        var index = height.indexOf(Math.min.apply(Math, height))
        // Lisää pisin pituus kaikkiin paitsi pisimpään.
        for (j = 0; j < texts.length; j++) {
            texts[j].style.height = Math.min.apply(Math, height) + "px"
        }
    }
    texts[index].style.height = "fit-content"    
}