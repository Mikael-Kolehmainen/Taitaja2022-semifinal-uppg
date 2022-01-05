<?php
    $servername = "localhost";
    $username = "ta22s1020_user";
    $password = "Iohae3fiuph5";
    $dbname = "ta22s1020_DB";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>