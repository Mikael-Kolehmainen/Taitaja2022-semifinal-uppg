function myFunction() {
  links = document.getElementById('myLinks')
  hamburgerImg = document.getElementById("hamburgerImage")
  if (links.style.display === 'block') {
    links.style.display = 'none'
    hamburgerImg.src = "img/icon/menu-bars.png"
  } else if (window.innerWidth < 900) {
    links.style.display = 'block'
    hamburgerImg.src = "img/icon/close.png"
  }
}