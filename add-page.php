<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sitename"])) {
        // Create html file
        $sitename_url = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_POST["sitename"]));
        $myFile = $sitename_url.".php";
        $fh = fopen($myFile, "w") or exit("Error creation");
        // Save data to database
        require 'connection.php';
        session_start();

        $siteName = $_POST['sitetitle'];
        $siteTitle = $_POST['sitetitle'];
        $siteImage = 'img/unsplash_images/'.$_POST['siteimage'];
        $contentIDs = $_SESSION['contentAmount'];
        
        $sql = "INSERT INTO sivut (nimi, nimiurl, otsikko, teemakuva, sisalto) 
                    VALUES ('$siteName', '$myFile', '$siteTitle', 
                    '$siteImage', '$contentIDs')";
        mysqli_query($conn, $sql);

       // $contentdb = "SELECT id, alaotsikko, tekstit, kuvat FROM sisalto";
        // save php code to $content as in echo the code, the variables from database
        // Write html to html file
        $content = '
            <!DOCTYPE html>
            <?php
                require "connection.php";
                $sql = "SELECT id, nimi, nimiurl, otsikko, teemakuva, sisalto FROM sivut";
                $getData = mysqli_query($conn, $sql);
            ?>
            <?php require "html-tag.php" ?>
                <head>
                    <?php echo "<title>Ruosteinen Rauta Oy - {}</title>"; ?>
                    <meta name="robots" content="index, follow">
                    <?php require "head.php"?>
                </head>
                <body>
                    <?php require "header.php"?>
                    <div id="feature-img" style="background-image: url()">
                        <h1>{}</h1>
                    </div>
                    <section>
        ';
        for ($i = 1; $i <= $_SESSION['contentAmount']; $i++) {
            $subtitle = $_POST["subtitle$i"];
            $subtext = $_POST["subtext$i"];
            $subimage = "img/unsplash_images/".$_POST["subimage$i"];
            if ($i % 2 != 0 || $i == 1) {
                $content .= "
                        <article>
                            <div class='row'>
                                <div class='left'>
                                    <h1>{$subtitle}</h1>
                                    <p>{$subtext}</p>
                                </div>
                                <aside class='rightImg'><img src='$subimage' alt=''></aside>
                            </div>
                        </article>
                ";
            } else {
                $content .= "
                        <article>
                            <div class='row'>
                                <div class='right'>
                                    <h1>{$subtitle}</h1>
                                    <p>{$subtext}</p>
                                </div>
                                <aside class='leftImg'><img src='$subimage' alt=''></aside>
                            </div>
                        </article>
                ";
            }
        }
        $content .= "
                    </section>
                    <?php require 'footer.php'?>
                </body>
            </html>
        ";
        fwrite($fh, $content);
        fclose($fh);

       /* echo "<script>
                alert('Siirry uudelle sivulle.');
                window.location.href = '$myFile';
                </script>"; */
    } else {
        echo "<script>
                alert('Jotain meni vikaan.');
                window.location.href = 'index.php';
                </script>";
    }
?>