<?php
    $servername = "localhost";
    $dbusername = "root";
    $password = "";
    $dbname = "taitaja22TK";

    // Create connection
    $conn = mysqli_connect($servername, $dbusername, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>