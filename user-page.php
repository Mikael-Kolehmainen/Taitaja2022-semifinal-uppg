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
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $sql = "SELECT id, kayttajanimi, rooli, salasana FROM kayttajat";
                $sql2 = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
                $result = mysqli_query($conn, $sql);
                $secondResult = mysqli_query($conn, $sql);
                $result2 = mysqli_query($conn, $sql2);

                $username = $_REQUEST['username'];
                $pw = $_REQUEST['pw'];

                $users = array();
                $welcometexts = array();
                if (mysqli_num_rows($result2) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                        $row = mysqli_fetch_assoc($result2);
                        array_push($welcometexts, $row['tervehdys']);
                    }
                }
                if (mysqli_num_rows($secondResult) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($secondResult); $i++) {
                        $row = mysqli_fetch_assoc($secondResult);
                        array_push($users, $row['kayttajanimi']);
                    }
                    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                        $row = mysqli_fetch_assoc($result);
                        $dbpw = substr($row['salasana'], 5);
                        if ($username == $row['kayttajanimi'] && password_verify($pw, $dbpw) == 1) {
                            // Käyttäjänimi ja salasana ovat oikein.
                            echo "<section style='margin-top: 50px;' id='adminPage'>
                                    <article>
                                        <div class='row'>
                                            <div class=''>
                                                <h1>Tervetuloa ".$username."</h1>";
                            echo "
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
                                                <script>
                                                    function changeWelcome() {
                                                        if (confirm('Oletteko varma että haluatte vaihtaa tervehdystekstin kotisivulla?') == true) {
                                                            window.location.href = 'change-welcome.php?currenttext=$welcometexts[$i]';
                                                        }
                                                    }
                                                </script>
                                                <a onclick='changeWelcome()'>Vaihda tekstiin</a>
                                            </td>
                                            <td>
                                                <script>
                                                    function removeWelcome() {
                                                        if (confirm('Oletteko varma että haluatte poistaa tervehdystekstin tietokannasta?') == true) {
                                                            window.location.href = 'remove-welcome.php?currenttext=$welcometexts[$i]';
                                                        }
                                                    }
                                                </script>
                                                <a onclick='removeWelcome()'>Poista teksti</a>
                                            </td>
                                        </tr>";
                                }
                            echo "</table>";
                            echo "
                                <h2>Hallitse sivuja</h2>
                                <h3>Etusivun tervehdysteksti</h3>
                                <form id='changewelcome' action='add-welcome.php' method='POST' autocomplete='off'>
                                    <textarea id='welcomeinput' name='welcometext' autcomplete='off' required></textarea><br>
                                    <input type='submit' value='Vaihda' id='changebtn'>
                                </form>
                                ";
                            if ($row['rooli'] == 'admin') {
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
                                                    <script>
                                                        function removeUser() {
                                                            if (confirm('Oletteko varma että haluatte poistaa käyttäjän?') == true) {
                                                                window.location.href = 'remove-user.php?username=$users[$i]';
                                                            }
                                                        }
                                                    </script>
                                                    <a onclick='removeUser()'>Poista käyttäjä</a>
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
                           /* setcookie('username', '', time() - 3600, "/");
                            setcookie('users', '', time() - 3600, "/");
                            setcookie('role', '', time() - 3600, "/"); */

                            // Eväste päättyy 30min sisään kirjautumisen jälkeen.
                            setcookie('username', $row['kayttajanimi'], time() + (60 * 30), "/");
                            $users = serialize($users); 
                            setcookie('users', $users, time() + (60 * 30), "/");
                            setcookie('role', $row['rooli'], time() + (60 * 30), "/");

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
            } else if (isset($_COOKIE['username'])) {
                $users = $_COOKIE['users'];
                $users = stripslashes($users);     
                $users = unserialize($users);
                echo "<section style='margin-top: 50px;'>
                                    <article>
                                        <div class='row'>
                                            <div class='left'>
                                                <h1>Tervetuloa ".$_COOKIE['username']."</h1>";
                        if ($_COOKIE['role'] == 'admin') {
                            echo "
                                <h2>Hallitse käyttäjiä</h2>
                                <table id='users'>
                                    <tr>
                                        <td style='font-weight: bold'>Käyttäjänimi</td>
                                    </tr>";
                                for ($i = 0; $i < count($users); $i++) {
                                    if ($_COOKIE['username'] != $users[$i]) {
                                        echo "<tr>
                                                <td>
                                                    $users[$i]
                                                </td>
                                                <td>
                                                    <script>
                                                        function removeUser() {
                                                            if (confirm('Oletteko varma että haluatte poistaa käyttäjän?') == true) {
                                                                window.location.href = 'remove-user.php?username=$users[$i]';
                                                            }
                                                        }
                                                    </script>
                                                    <a onclick='removeUser()'>Poista käyttäjä</a>
                                                </td>
                                            </tr>";
                                    }
                                }
                            }
                            echo "</table>";
                            echo"           </div>
                                        </div>
                                    </article>
                                </section>"; 
            // Jos ei ole kirjautunut, lähetetään takaisin login.php
            } else {
                echo "<script>
                    alert('Kirjaudu sisään jotta pääset eteenpäin.');
                    window.location.href = 'login.php';
                    </script>";
            }
            mysqli_close($conn);
        ?>
        <?php require 'footer.php' ?>
    </body>
</html>