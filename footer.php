<?php
    echo '
        <footer>
            <h1 style="text-align: center">Ota yhteyttä</h1>
            <!-- Yhteystiedot -->
            <div id="rest">
                <img src="img/logo/Logo_light.png" alt="Company logo"><br>
                <img id="yrittajat" src="img/SY_satakunta_RGB_musta.jpg" alt="Yrittäjät">
                <h2>Ruosteinen Rauta Oy</h2>
                <p>Urheilutie 1,</p>
                <p>28500 Pori</p>
                <p>Puh. 044 7011442</p>
                <p>info@ruosteinenrauta.fi</p>
            </div>
            <!-- Yhteydenottolomake -->
            <aside>
                <h2>Yhteydenottolomake</h2>
                <form id="contact-us" name="contact-us" action="contact.php" method="POST" autocomplete="off">
                    <div class="floating-label-group">
                        <input type="text" id="fname" name="fname" class="form-control" autocomplete="off" required />
                        <label class="floating-label">Etunimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="lname" name="lname" class="form-control" autocomplete="off" required />
                        <label class="floating-label">Sukunimi</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="phone" name="phone" class="form-control" autocomplete="off" required />
                        <label class="floating-label">Puhelinnumero</label>
                    </div>
                    <div class="floating-label-group">
                        <input type="text" id="e-mail" name="e-mail" class="form-control" autocomplete="off" required />
                        <label class="floating-label">Sähköposti</label>
                    </div>
                    <div class="floating-label-group">
                        <textarea id="msg" name="msg" class="form-control" autocomplete="off" required></textarea>
                        <label class="floating-label">Viesti</label>
                    </div>
                    <input id="confirmation" type="submit" value="Lähetä" style="margin-top: 15px">
                </form>
            </aside>
            <p id="creator">Mikael Kolehmainen &copy; 2022</p>
        </footer>
    ';
?>