function myFunction() {
  links = document.getElementById('myLinks')
  if (links.style.display === 'block') {
    links.style.display = 'none'
  } else if (window.innerWidth < 900) {
    links.style.display = 'block'
  }
}