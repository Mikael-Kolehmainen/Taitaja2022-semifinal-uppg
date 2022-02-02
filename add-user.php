<?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $newusername = $_REQUEST["username"];
        $pw = $_REQUEST["pw"];
        $role = $_POST['role'];
        $userexists = false;

        require 'connection.php';

        $sql = "SELECT id, kayttajanimi, rooli, salasana FROM kayttajat";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $row = mysqli_fetch_assoc($result);
                if ($newusername == $row['kayttajanimi']) {
                    $userexists = true;
                }
            }
        }
        if ($userexists == false) {
            require 'random-string.php';

            $pw = getRandomString(5).password_hash($pw, PASSWORD_DEFAULT);

            $sql = "INSERT INTO kayttajat (kayttajanimi, salasana, rooli)
            VALUES ('$newusername', '$pw', '$role')";

            if (mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Käyttäjä on lisätty.');
                        window.location.href = 'user-page.php';
                    </script>";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else if ($userexists == true) {
            echo 'hello';

            echo "
                <script>
                    alert('Käyttäjänimi on jo käytössä.');
                    window.location.href = 'user-page.php';
                </script>";
        }
        
    }
?>