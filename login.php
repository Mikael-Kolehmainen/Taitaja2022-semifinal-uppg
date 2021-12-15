<!DOCTYPE html>
<html>
    <head>
        <title>Ruosteinen Rauta Oy - Etusivu</title>
        <!-- Favicon -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Stylesheets -->
        <link href="main.css" rel="stylesheet" type="text/css">
        <!-- Scripts -->
        <script src="sticky.js" async></script>
    </head>
    <body>
        <div class="float-container" id="top">
            <header>
                <img src="img/logo/Logo light.png" alt="Company logo">
            </header>
            <nav>
                <ul>
                    <a href="index.php"><li>Etusivu</li></a>
                    <a href="template.php"><li>Esimerkkisivu</li></a>
                    <a href="login.php" class="active"><li class="active">Kirjaudu</li></a>
                </ul>
            </nav>
        </div>
        <footer>
            <h1>Ota yhteyttä</h1>
            <!-- Yhteystiedot -->
            <div id="rest">
                <img src="img/logo/Logo light.png" alt="Company logo">
                <h2>Ruosteinen Rauta Oy</h2>
                <p>Urheilutie 1,</p>
                <p>28500 Pori</p>
                <p>Puh. 044 7011442</p>
                <p>info@ruosteinenrauta.fi</p>
            </div>
            <!-- Yhteydenottolomake -->
            <aside>
                <form id="contact-us" name="contact-us" action="" method="POST" autocomplete="off">
                    <div class="floating-label-group">
                        <input type="text" id="fname" name="fname" class="form-control" autocomplete="off" autofocus required />
                        <label class="floating-label">Etunimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="lname" name="lname" class="form-control" autocomplete="off" autofocus required />
                        <label class="floating-label">Sukunimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="phone" name="phone" class="form-control" autocomplete="off" autofocus required />
                        <label class="floating-label">Puhelinnumero</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="e-mail" name="e-mail" class="form-control" autocomplete="off" autofocus required />
                        <label class="floating-label">Sähköposti</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="msg" name="msg" class="form-control" autocomplete="off" autofocus required />
                        <label class="floating-label">Viesti</label>
                    </div>
                    <input id="confirmation" type="submit" value="Lähetä">
                </form>
            </aside>
            <p>Mikael Kolehmainen &copy; 2022</p>
        </footer>
    </body>
</html>