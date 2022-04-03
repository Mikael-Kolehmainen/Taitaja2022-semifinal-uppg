<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sitename"])) {
        require 'connection.php';
        $sql = "SELECT nimi, nimiurl FROM sivut";
        $result = mysqli_query($conn, $sql);
        $alreadyInDb = false;
        if (mysqli_num_rows($result) > 0) {
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $row = mysqli_fetch_assoc($result);
                // Checks if sitename is available
                if ($_POST['sitename'] == $row['nimi']
                    || $_POST['sitename'] == $row['nimiurl']) {
                        $alreadyInDb = true;
                        echo "<script>
                        alert('Sivunimi on jo olemassa');
                        window.location.href = 'user-page.php';
                        </script>"; 
                }
            }
        }
        if ($alreadyInDb == false) {
            // Create html file
            $sitename_url = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($_POST["sitename"]));
            $myFile = $sitename_url.".php";
            $fh = fopen($myFile, "w") or exit("Error creation");
            // Save data to database
            require 'connection.php';
            session_start();

            $siteName = $_POST['sitename'];
            $siteTitle = $_POST['sitetitle'];
            $siteImage = 'img/unsplash_images/'.$_POST['siteimage'];
            $contentIDs = $_SESSION['contentAmount'];
            
            $sql = "INSERT INTO sivut (nimi, nimiurl, otsikko, teemakuva, sisalto) 
                        VALUES ('$siteName', '$myFile', '$siteTitle', 
                        '$siteImage', '$contentIDs')";
            mysqli_query($conn, $sql);

            // Insert alaotsikko, tekstit, kuvat to sisalto database
            // Save the ids of rows to sivut db in format ID;ID;ID;
            // For loop as below with the ids, get data from sisalto db and for loop how many ids

            // Write html to html file
            $content = '
                <!DOCTYPE html>
                <?php
                    $siteName = ';
            $content .= "'$siteName';";
            $content .= '
                    require "connection.php";
                    $sql = "SELECT id, nimi, nimiurl, otsikko, teemakuva, sisalto FROM sivut";
                    $getData = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($getData) > 0) {
                        for ($i = 0; $i < mysqli_num_rows($getData); $i++) {
                            $row = mysqli_fetch_assoc($getData);
                            if ($siteName == $row["nimi"]) {
                ?>
                                <?php require "html-tag.php" ?>
                                    <head>
                                        <?php echo "<title>Ruosteinen Rauta Oy - {$row["nimi"]}</title>"; ?>
                                        <meta name="robots" content="index, follow">
                                        <?php require "head.php"?>
                                    </head>
                                    <body>
                                        <?php require "header.php"?>
                                        <div id="feature-img" style="background-image: url(<? php echo $row["teemakuva"]; ?>)">
                                            <?php echo "<h1>{$row["otsikko"]}</h1>" ?>
                                        </div>
                                        <section>
                <?php
                            }
                        }
                    }
                ?>
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
        }
    } else {
        echo "<script>
                alert('Jotain meni vikaan.');
                window.location.href = 'index.php';
                </script>";
    }
?>