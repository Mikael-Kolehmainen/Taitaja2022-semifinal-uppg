<?php
    // Check if post has value before sending it to database
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editPageForm"])) {
        session_start();
        $siteID = $_SESSION['siteID'];
        require 'connection.php';
        $selectSite = "SELECT id, nimi, nimiurl, otsikko, teemakuva, sisalto_id FROM sivut";
        $siteResult = mysqli_query($conn, $selectSite);
        if (mysqli_num_rows($siteResult)) {
            for ($i = 0; $i < mysqli_num_rows($siteResult); $i++) {
                $row = mysqli_fetch_assoc($siteResult);
                if ($siteID == $row['id']) {
                    // Gö variablar till alla delar som skall updateras om posterna är tomma sätt gamla värden

                }
            }
        }
    }
    function setValue($post, $dbvalue) {
        
        // returns variable that will be sent to database
        return $send;
    }
?>