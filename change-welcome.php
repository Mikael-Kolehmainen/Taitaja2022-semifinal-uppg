<?php
    require 'connection.php';

    $sql = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);

            if ($_REQUEST['currenttext'] == $row['tervehdys']) {
                $sql = "UPDATE tervehdysteksti SET nykyinen=1 WHERE id=$row[id]";
            } else {
                $sql = "UPDATE tervehdysteksti SET nykyinen=0 WHERE id=$row[id]";
            }
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Teksti on päivitetty.');
                        window.location.href = 'user-page.php';
                    </script>";
            }
        }
    }
?>