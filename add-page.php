<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sitename"])) {
        require 'connection.php';
        $sql = "SELECT nimi, nimiurl FROM sivut";
        $result = mysqli_query($conn, $sql);
        $alreadyInDb = false;
        session_start();
        $amountOfContents = $_SESSION['contentAmount'];
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
        $sql = "SELECT alaotsikko FROM sisalto";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                $row = mysqli_fetch_assoc($result);
                // Checks if subtitle is available
                for ($j = 1; $j <= $amountOfContents; $j++) {
                    if ($_POST["subtitle$j"] == $row['alaotsikko']) {
                        $alreadyInDb = true;
                        echo "<script>
                            alert('Alaotsikko on jo olemassa');
                            window.location.href = 'user-page.php';
                            </script>"; 
                    }
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

            // Send content to database
            for ($i = 1; $i <= $amountOfContents; $i++) {

                $subTitle = $_POST["subtitle$i"];
                $subText = $_POST["subtext$i"];
                $subImageExt = pathinfo($_FILES["subimage$i"]["name"], PATHINFO_EXTENSION);
                $subImagePath = "img/unsplash_images/".$sitename_url."_".$_POST["subtitle$i"].".".$subImageExt;

                // Save the image to project folder
                if (move_uploaded_file($_FILES["subimage$i"]["tmp_name"], $subImagePath)) {
                    $contentOfPage = "INSERT INTO sisalto (alaotsikko, teksti, kuva)
                                    VALUES ('$subTitle', '$subText', '$subImagePath')";
                    mysqli_query($conn, $contentOfPage);
                }
            }

            // Get the IDs of the content rows in database
            $IDs = "";
            $getIDs = "SELECT id, alaotsikko FROM sisalto";
            $result = mysqli_query($conn, $getIDs);
            if (mysqli_num_rows($result) > 0) {
                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                    $row = mysqli_fetch_assoc($result);
                    $j = $i + 1;
                    // If the subtitles are equal then save the ID of that row
                    for ($j = 1; $j <= $amountOfContents; $j++) {
                        if ($row['alaotsikko'] == $_POST["subtitle$j"]) {
                            $IDs .= $row['id'].";";
                        }
                    }
                }
            }

            // Send general site data to database
            $siteName = $_POST['sitename'];
            $siteTitle = $_POST['sitetitle'];
            $siteImage = 'img/unsplash_images/'.$_POST['siteimage'];

            // download uploaded image WRITE CODE HERE
            
            $page = "INSERT INTO sivut (nimi, nimiurl, otsikko, teemakuva, sisalto_id) 
                        VALUES ('$siteName', '$myFile', '$siteTitle', 
                        '$siteImage', '$IDs')";
            mysqli_query($conn, $page);

            // Write html to html file
            $content = '
                <!DOCTYPE html>
                <?php
                    $siteName = ';
            $content .= "'$siteName';";
            $content .= '
                    require "connection.php";
                    $sql = "SELECT id, nimi, nimiurl, otsikko, teemakuva, sisalto_id FROM sivut";
                    $getData = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($getData) > 0) {
                        for ($i = 0; $i < mysqli_num_rows($getData); $i++) {
                            $row = mysqli_fetch_assoc($getData);
                            if ($siteName == $row["nimi"]) {
                                require "html-tag.php"    ?>
                                    <head>
                                        <?php echo "<title>Ruosteinen Rauta Oy - {$row["nimi"]}</title>"; ?>
                                        <meta name="robots" content="index, follow">
                                        <?php require "head.php"?>
                                    </head>
                                    <body>
                                        <?php require "header.php"?>
                                        <div id="feature-img" style="background-image: url(<?php echo $row["teemakuva"]; ?>)">
                                            <?php echo "<h1>{$row["otsikko"]}</h1>" ?>
                                        </div>
                                        <section>
                <?php
                                $IDs = explode(";", $row["sisalto_id"]);
                                $rowIndex = 0;
                                $sql2 = "SELECT id, alaotsikko, teksti, kuva FROM sisalto";
                                $getContent = mysqli_query($conn, $sql2);
                                if (mysqli_num_rows($getContent) > 0) {
                                    for ($j = 0; $j < mysqli_num_rows($getContent); $j++) {
                                        $row2 = mysqli_fetch_assoc($getContent);
                                        for ($k = 0; $k < count($IDs); $k++) {
                                            if ($row2["id"] == $IDs[$k]) {
                                                $rowIndex = $rowIndex + 1;
                                                if ($rowIndex % 2 != 0 || $rowIndex == 1) {
                                                    echo "
                                                        <article>
                                                            <div class=\'row\'>
                                                                <div class=\'left\'>
                                                                    <h1>{$row2["alaotsikko"]}</h1>
                                                                    <p>{$row2["teksti"]}</p>
                                                                </div>
                                                                <aside class=\'rightImg\'><img src={$row2[\'kuva\']} alt=\'\'></aside>
                                                            </div>
                                                        </article>
                                                    ";
                                                } else {
                                                    echo "
                                                        <article>
                                                            <div class=\'row\'>
                                                                <div class=\'right\'>
                                                                    <h1>{$row2["alaotsikko"]}</h1>
                                                                    <p>{$row2["teksti"]}</p>
                                                                </div>
                                                                <aside class=\'leftImg\'><img src={$row2[\'kuva\']} alt=\'\'></aside>
                                                            </div>
                                                        </article>
                                                    ";
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                ?>
            ';
            $content .= "
                        </section>
                        <?php require 'footer.php'?>
                    </body>
                </html>
            ";
            fwrite($fh, $content);
            fclose($fh);

             echo "<script>
                        alert('Siirry uudelle sivulle.');
                        window.location.href = '$myFile';
                        </script>";
        }
    } else {
        echo "<script>
                alert('Jotain meni vikaan.');
                window.location.href = 'index.php';
                </script>";
    }
?>