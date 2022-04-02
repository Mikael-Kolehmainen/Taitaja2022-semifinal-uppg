<?php
    require 'connection.php';

    $sql = "SELECT id, kayttajanimi, rooli, salasana FROM kayttajat";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        for ($i = 0; $i < mysqli_num_rows($result); $i++) {
            $row = mysqli_fetch_assoc($result);
            if ($_REQUEST['username'] == $row['kayttajanimi']) {
                $sql = "DELETE FROM kayttajat WHERE id=$row[id]";
                if (mysqli_query($conn, $sql)) {
                    echo "<script>
                            alert('Käyttäjä poistettu.');
                            window.location.href = 'user-page.php';
                        </script>";
                } else {
                    echo "Error deleting record: " . mysqli_error($conn);
                }
            }
        }
    }
?>