<?php
    require 'connection.php';

    $sql = "SELECT id, tervehdys, nykyinen FROM tervehdysteksti";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            if ($_REQUEST['currenttext'] == $row['tervehdys']) {
                $sql = "DELETE FROM tervehdysteksti WHERE id=$row[id]";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                            alert('Teksti poistettu tietokannasta.');
                            window.location.href = 'user-page.php';
                        </script>";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
    }
?>