let style = document.createElement('style');

function myFunction() {
    if (style.innerHTML == `.float-container #myLinks { display: block;}`) {
      style.innerHTML = `.float-container #myLinks { display: none;}`
    } else {
      style.innerHTML = `.float-container #myLinks { display: block;}`
    }
    document.head.appendChild(style);
}