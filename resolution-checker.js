window.addEventListener('resize', function(event){
    var newWidth = window.innerWidth;
    // var newHeight = window.innerHeight;
    if (newWidth > 900) {
        changeLinksDisplay()
    }
});

function changeLinksDisplay() {
    links = document.getElementById('myLinks')

    links.style.display = 'block'
}