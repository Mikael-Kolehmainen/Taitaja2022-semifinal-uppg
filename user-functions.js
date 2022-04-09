function changeWelcome(currentText) {
    if (confirm('Oletteko varma että haluatte vaihtaa tervehdystekstin kotisivulla?') == true) {
        window.location.href = 'change-welcome.php?currenttext=' + currentText;
    }
}
function removeWelcome(currentText) {
    if (confirm('Oletteko varma että haluatte poistaa tervehdystekstin tietokannasta?') == true) {
        window.location.href = 'remove-welcome.php?currenttext=' + currentText;
    }
}
function removeUser(currentUser) {
    if (confirm('Oletteko varma että haluatte poistaa käyttäjän?') == true) {
        window.location.href = 'remove-user.php?username=' + currentUser;
    }
}
function removeSite(currentSite) {
    if (confirm('Oletteko varma että haluatte poistaa sivun') == true) {
        window.location.href = 'remove-site.php?site=' + currentSite;
    }
}