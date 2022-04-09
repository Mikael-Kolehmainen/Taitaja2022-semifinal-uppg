<!DOCTYPE html>
<html>
    <head>
        <title>Ruosteinen Rauta Oy - Käyttäjäsivu</title>
        <meta name="robots" content="noindex">
        <?php require 'head.php' ?>
    </head>
    <body>
        <?php 
            require 'header.php';
            require 'connection.php';

            $amountOfWrongPws = 0;

            // Jos kirjaudutaan sisään login.php:sta
            if ($_SERVER["REQUEST_METHOD"] == 'POST' && isset($_POST["username"])) {
                $sql = "SELECT id, kayttajanimi, rooli, salasana FROM kayttajat";
                $sql2 = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
                $result = mysqli_query($conn, $sql);
                $secondResult = mysqli_query($conn, $sql);
                $result2 = mysqli_query($conn, $sql2);

                $username = $_REQUEST['username'];
                $pw = $_REQUEST['pw'];  
                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                        $row = mysqli_fetch_assoc($result);
                        $dbpw = substr($row['salasana'], 5);
                        if ($username == $row['kayttajanimi'] && password_verify($pw, $dbpw) == 1) {
                            // Käyttäjänimi ja salasana ovat oikein.
                            // Eväste päättyy 30min sisään kirjautumisen jälkeen.
                            setcookie('username', $row['kayttajanimi'], time() + (60 * 30), "/");
                            setcookie('role', $row['rooli'], time() + (60 * 30), "/");
                            showWebsite($username, $row['rooli']);

                        } else if ($username == $row['kayttajanimi'] && password_verify($pw, $dbpw) == 0) {
                            // Salasana oli väärä.
                            echo "<script>
                                    alert('Salasana on väärä.');
                                    window.location.href = 'login.php';
                                    </script>";
                        } else if ($username != $row['kayttajanimi']) {
                            // Käyttäjänimi oli väärä.
                            $amountOfWrongPws = $amountOfWrongPws + 1;
                            // Amount of wrong passwords == number of rows, then username was wrong
                            if ($amountOfWrongPws == mysqli_num_rows($result)) {
                                echo "<script>
                                    alert('Käyttäjänimeä ei löydy tietokannasta.');
                                    window.location.href = 'login.php';
                                    </script>";
                            }
                        }
                    }
                } // Jos on aiemmin kirjautunut sisään ja eväste vielä voimassa.
                mysqli_close($conn);
            } else if (isset($_COOKIE['username']) && isset($_COOKIE['role'])) {
                showWebsite($_COOKIE['username'], $_COOKIE['role']);
            // Jos ei ole kirjautunut, lähetetään takaisin login.php
            } else {
                echo "<script>
                    alert('Kirjaudu sisään jotta pääset eteenpäin.');
                    window.location.href = 'login.php';
                    </script>";
            }
            function showWebsite($username, $role) {
                require 'connection.php';
                $users = "SELECT id, kayttajanimi, rooli, salasana FROM kayttajat";
                $welcome = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
                $sites = "SELECT nimiurl FROM sivut";
                $usersResult = mysqli_query($conn, $users);
                $usersSecondResult = mysqli_query($conn, $users);
                $welcomeResult = mysqli_query($conn, $welcome);
                $sitesResult = mysqli_query($conn, $sites);

                $users = array();
                $welcometexts = array();
                $sites = array();
                // We save welcome texts to an array so we can print it later
                if (mysqli_num_rows($welcomeResult) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($welcomeResult); $i++) {
                        $row = mysqli_fetch_assoc($welcomeResult);
                        array_push($welcometexts, $row['tervehdys']);
                    }
                }
                // We save all users to an array so we can print it later
                if (mysqli_num_rows($usersSecondResult) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($usersSecondResult); $i++) {
                        $row = mysqli_fetch_assoc($usersSecondResult);
                        array_push($users, $row['kayttajanimi']);
                    }
                }
                // We save all sites to an array so we can print it later
                if (mysqli_num_rows($sitesResult) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($sitesResult); $i++) {
                        $row = mysqli_fetch_assoc($sitesResult);
                        array_push($sites, $row['nimiurl']);
                    }
                }
                echo "<section style='margin-top: 50px;' id='adminPage'>
                        <article>
                            <div class='row'>
                                <div class=''>
                                    <h1>Tervetuloa ".$username."</h1>
                        <h2>Hallitse sivuja</h2>
                            <table>
                                <tr>
                                    <td style='font-weight: bold'>Sivut</td>
                                </tr>";
                for ($i = 0; $i < count($sites); $i++) {
                    echo "<tr>
                            <td>
                                $sites[$i]
                            </td>
                            <td>
                                <a onclick='editSite(\"$sites[$i]\")'>Editoi sivua</a>
                            </td>
                            <td>
                                <a onclick='removeSite(\"$sites[$i]\")'>Poista sivu</a>
                            </td>
                        <tr>";
                }
                echo   "</table>
                        <h3>Lisää sivu</h3>
                            <form action='user-page.php' autocomplete='off' method='POST'>
                                <label>Montako sisältöpaikkaa haluat?</label>
                                <select id='content' name='contentAmount' class='form-control' required>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                </select>
                                <input type='submit' value='Vahvista' id='changebtn'>
                            </form>";
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["contentAmount"])) {
                    session_start();
                    $_SESSION['contentAmount'] = $_POST['contentAmount'];
                    echo   "
                            <p>Sisältöpaikkaa: {$_POST['contentAmount']}</p>
                            <form action='add-page.php' autocomplete='off' method='POST' enctype='multipart/form-data'>
                                <label for='sitename'>Sivunimi:</label>
                                <input type='text' name='sitename' autocomplete='off' required><br>
                                <label for='sitetitle'>Sivun otsikko:</label>
                                <input type='text' name='sitetitle' autocomplete='off' required><br>
                                <label for='siteimage'>Sivun teemakuva:</label>
                                <input type='file' accept='image/png, image/jpeg' name='siteimage' autcomplete='off'><br>";
                            for ($i = 1; $i <= $_POST['contentAmount']; $i++) {
                                echo "
                                    <h5>Sisältöpaikka $i</h5>
                                    <label for='subtitle'>Alaotsikko:</label>
                                    <input type='text' name='subtitle$i' autcomplete='off' required><br>
                                    <label for='subtext'>Teksti: </label><br>
                                    <textarea name='subtext$i' id='welcomeinput' autocomplete='off' required></textarea><br>
                                    <label for='subimage'>Sisältöpaikan kuva:</label>
                                    <input type='file' accept='image/png, image/jpeg' name='subimage$i' autocomplete='off'><br>
                                ";
                            }
                    echo   "
                                <input type='submit' value='Luo sivu' id='changebtn'>
                            </form>";
                }
                echo "
                    <h2>Hallitse tervehdystekstejä</h2>
                    <table id='welcometexts'>
                        <tr>
                            <td style='font-weight: bold'>Tervehdystekstit</td>
                        </tr>";
                for ($i = 0; $i < count($welcometexts); $i++) {
                    echo "<tr>
                            <td>
                                $welcometexts[$i]
                            </td>
                            <td>
                                <a onclick='changeWelcome(\"$welcometexts[$i]\")'>Vaihda tekstiin</a>
                            </td>
                            <td>
                                <a onclick='removeWelcome(\"$welcometexts[$i]\")'>Poista teksti</a>
                            </td>
                        </tr>";
                }
                echo "</table>
                    <h3>Lisää tervehdysteksti</h3>
                    <form id='changewelcome' action='add-welcome.php' method='POST' autocomplete='off'>
                        <textarea id='welcomeinput' name='welcometext' autcomplete='off' required></textarea><br>
                        <input type='submit' value='Vaihda' id='changebtn'>
                    </form>
                    ";
                if ($role == 'admin') {
                    echo "
                    <h2>Hallitse käyttäjiä</h2>
                    <table id='users'>
                        <tr>
                            <td style='font-weight: bold'>Käyttäjänimi</td>
                        </tr>";
                    for ($i = 0; $i < count($users); $i++) {
                        if ($username != $users[$i]) {
                            echo "<tr>
                                    <td>
                                        $users[$i]
                                    </td>
                                    <td>
                                        <a onclick='removeUser(\"$users[$i]\")'>Poista käyttäjä</a>
                                    </td>
                                </tr>";
                        }
                    }
                    echo "</table>";
                    echo "
                        <h3>Lisää käyttäjä</h3>
                        <form id='adduser' action='add-user.php' method='POST' autocomplete='off'>
                            <label for='username'>Käyttäjänimi:</label> 
                            <input type='text' name='username' autocomplete='off' required>
                            <label for='pw'>Salasana:</label>
                            <input type='text' name='pw' autocomplete='off' required>
                            <input type='radio' name='role' id='admin' value='admin' required>
                            <label for='admin'>admin</label>
                            <input type='radio' name='role' id='editor' value='editor' required>
                            <label for='editor'>editor</label>
                            <input type='submit' value='Luo'>
                        </form>";
                }
                echo"           </div>
                            </div>
                        </article>
                    </section>";
            }
        ?>
        <?php require 'footer.php' ?>
    </body>
</html>