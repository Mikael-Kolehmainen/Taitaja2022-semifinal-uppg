<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php' ?>
    </head>
    <body>
        <?php 
            require 'header.php';
            require 'connection.php';

            $amountOfWrongPws = 0;

            // Jos kirjaudutaan sisään login.php:sta
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {
                $sql = "SELECT id, kayttajanimi, salasana FROM kayttajat";
                $result = mysqli_query($conn, $sql);

                $username = $_REQUEST['username'];
                $pw = $_REQUEST['pw'];

                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                        $row = mysqli_fetch_assoc($result);
                        $dbpw = substr($row['salasana'], 5);
                        if ($username == $row['kayttajanimi'] && password_verify($pw, $dbpw) == 1) {
                            // Käyttäjänimi ja salasana ovat oikein.
                            echo "<section style='margin-top: 50px;'>
                                    <article>
                                        <div class='row'>
                                            <div class='left'>
                                                <h1>Tervetuloa ".$username."</h1>
                                            </div>
                                        </div>
                                    </article>
                                </section>";
                            // Eväste päättyy 30min sisään kirjautumisen jälkeen.
                            setcookie('username', $username, time() + (60 * 30), "/");
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
            } else if (isset($_COOKIE[$username])) {
                echo "
                <section style='margin-top: 50px;'>
                    <article>
                        <div class='row'>
                            <div class='left'>
                                <h1>Tervetuloa ".$_COOKIE[$username]."</h1>
                            </div>
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