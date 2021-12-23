<!DOCTYPE html>
<html>
    <head>
        <?php require 'head.php' ?>
    </head>
    <body>
        <?php 
            require 'header.php';
            require 'connection.php';
            require 'random-string.php';

            $amountOfWrongPws = 0;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $sql = "SELECT id, kayttajanimi, salasana, FROM kayttajat";
                $result = mysqli_query($conn, $sql);

                $username = $_REQUEST['username'];
                $pw = $_REQUEST['pw'];

                if (mysqli_num_rows($result) > 0) {
                    for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                        $row = mysqli_fetch_assoc($result);
                        if ($username == $row['kayttajanimi'] && password_verify($pw, $row['salasana']) == 1) {
                            echo "Kyllä!";
                        } else if ($username == $row['kayttajanimi'] && password_verify($pw, $row['salasana']) == 0) {
                            // Password was wrong
                            echo "<script>
                                    alert('Salasana on väärä.');
                                    window.location.href = 'login.php';
                                    </script>";
                        } else if ($username != $row['kayttajanimi']) {
                            // Username was wrong
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
                }
            }
            mysqli_close($conn);
        ?>
        <?php require 'footer.php' ?>
    </body>
</html>