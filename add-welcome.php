<?php
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        require 'connection.php';

        $welcomeText = $_REQUEST["welcometext"];

        $sql = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $row = mysqli_fetch_assoc($result);
                $sql = "UPDATE tervehdysteksti SET nykyinen=0 WHERE id=$row[id]";
                mysqli_query($conn, $sql);
            }
        }

        $sql = "INSERT INTO tervehdysteksti (tervehdys, nykyinen)
                VALUES ('$welcomeText', 1)";

        if (mysqli_query($conn, $sql)) {
            echo "
                <script>
                    alert('Tervehdysteksti on vaihdettu.');
                    window.location.href = 'user-page.php';
                </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>