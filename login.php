<!DOCTYPE html>
<html>
    <head>
        <title>Ruosteinen Rauta Oy - Etusivu</title>
        <?php require 'head.php'?>
    </head>
    <body id="background">
            <?php require 'header.php'?>
            <section id="login-page">
                <h1>Kirjaudu Sisään</h1>
                <form id="user" name="user" action="user-page.php" method="POST" autocomplete="off">
                    <div class="floating-label-group">
                        <input type="text" id="username" name="username" class="form-control user" autocomplete="off" required/>
                        <label class="floating-label">Käyttäjänimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="password" id="pw" name="pw" class="form-control user" autocomplete="off" required onchange="checkPasswords()"/>
                        <label class="floating-label">Salasana</label>
                    </div>
                    <p id="pwCheck"></p><br>
                    <input id="sign-in" type="submit" value="Kirjaudu" disabled>
                </form>
            </section>
            <!-- Yhteystiedot & Yhteydenottolomake -->
            <?php require 'footer.php'?>
    </body>
</html>