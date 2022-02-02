const open = []
function changeChevron(serviceNr) {
    serviceNr = serviceNr - 1
    var chevrons = document.getElementsByClassName('chevron')
    var chevronImg = chevrons[serviceNr].getElementsByTagName('img')[0]
    
    if (serviceNr > open.length) {
        open.push(false)
        open[serviceNr] = !open[serviceNr]
    } else {
        open[serviceNr] = !open[serviceNr]
    }
    if (open[serviceNr] == false) {
        chevronImg.src = "img/icon/chevron-down.png"
    } else if (open[serviceNr] == true) {
        chevronImg.src = "img/icon/chevron-up.png"
    }
  /*  if (open.includes(true)) {
        open.setAll(false, serviceNr)
        var count = 0
        open.forEach((v) => (v === false && count++))
        for (var i = 0; i <= count; i++) {
            chevrons[i].getElementsByTagName('img')[0].src = "img/icon/chevron-down.png"
        }
    } */
}

// Sulkee ne jotka ovat auki kun avataan toinen
const details = document.querySelectorAll("details")

details.forEach((targetDetail) => {
  targetDetail.addEventListener("click", () => {

    details.forEach((detail) => {
      if (detail !== targetDetail) {
          detail.removeAttribute("open")
      }
    });
  });
});
/*
// setAll() funktio
Array.prototype.setAll = function(v, e) {
    var n = this.length;
    for (var i = 0; i < n; i++) {
        if (i != e) {
            this[i] = v;
        }
    }
};*/
// då en är öppen skall alla andra stängas, sätt animationer