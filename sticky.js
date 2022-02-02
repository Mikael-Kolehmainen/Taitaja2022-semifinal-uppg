if (document.readyState == 'loading') {
    document.addEventListener('DOMContentLoaded', ready)
} else {
    ready()
}

function ready() {
    // window.onscroll = function() {myFunction()}

    var top = document.getElementById("top")
    // var sticky = top.offsetTop;

    top.classList.add("sticky")

    /*function myFunction() {
        if (window.pageYOffset >= sticky) {
            top.classList.add("sticky")
        } else {
            top.classList.remove("sticky")
        }
    } */
}