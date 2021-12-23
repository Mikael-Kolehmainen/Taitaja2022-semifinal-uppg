<!DOCTYPE html>
<html>
    <head>
        <title>Ruosteinen Rauta Oy - Etusivu</title>
        <?php require 'head.php'?>
    </head>
    <?php require 'onload.php'?>
        <?php require 'header.php'?>
        <section id="login-page">
                <form id="user" name="user" action="user-page.php" method="POST" autocomplete="off">
                    <div class="floating-label-group">
                        <input type="text" id="username" name="username" class="form-control" autocomplete="off" required />
                        <label class="floating-label">Käyttäjänimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="password" id="pw1" name="pw1" class="form-control" autocomplete="off" required/>
                        <label class="floating-label">Salasana</label>
                    </div>
                    <input id="sign-in" type="submit" value="Kirjaudu">
                </form>
        </section>
        <!-- Yhteystiedot & Yhteydenottolomake -->
        <?php require 'footer.php'?>
    </body>
</html>