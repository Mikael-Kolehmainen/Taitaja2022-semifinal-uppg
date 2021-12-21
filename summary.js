const open = []
function changeChevron(serviceNr) {
    serviceNr = serviceNr - 1
    var chevrons = document.getElementsByClassName('chevron')
    var chevronImg = chevrons[serviceNr].getElementsByTagName('img')[0]
    
    if ((serviceNr + 1) > open.length) {
        open.push(true)
        open[serviceNr] = !open[serviceNr]
    } else {
        open[serviceNr] = !open[serviceNr]
    }
    if (open[serviceNr] == false) {
        chevronImg.src = "img/icon/chevron-down.png"
    } else if (open[serviceNr] == true) {
        chevronImg.src = "img/icon/chevron-up.png"
    }
}

// då en är öppen skall alla andra stängas, sätt animationer