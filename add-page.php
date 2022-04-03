<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sitename"])) {
        // Create html file
        $sitename_url = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_POST["sitename"]));
        $myFile = $sitename_url.".html";
        $fh = fopen($myFile, "a+") or exit("Error creation");
        // Write html to html file
        fwrite($fh, "TESTI");
    } else {
        echo "<script>
                alert('Jotain meni vikaan.');
                window.location.href = 'index.php';
                </script>";
    }
?>