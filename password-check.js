function checkPasswords() {
    var pwcheck = document.getElementById('pwCheck')

    var pw = document.getElementById('pw').value

    var submitBtn = document.getElementById('sign-in')

    if (pw.length < 8) {
        submitBtn.disabled = true
        pwcheck.innerText = "Validointi: Vähintään 8 merkkiä."
    // Tarkistaa jos salasanassa ei ole numeroita
    } else if (/\d/.test(pw) == false) {
        submitBtn.disabled = true
        pwcheck.innerText = "Validointi: Vähintään 1 numero."
    // Tarkistaa jos salasanassa ei ole kirjaimia
    } else if (/[a-zA-Z]/.test(pw) == false) {
        submitBtn.disabled = true
        pwcheck.innerText = "Validointi: Vähintään 1 kirjain."
    } else {
        submitBtn.disabled = false
        pwcheck.innerText = "Validointi: Salasana on OK!"
    }
}