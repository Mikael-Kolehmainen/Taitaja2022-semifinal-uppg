<?php
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
                    $siteName = setValue($_POST['sitename'], $row['nimi']);
                    // make siteName url friendly
                    $siteName_url = preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities($siteName));
                    $siteName_url_db = $siteName_url.".php";
                    $siteTitle = setValue($_POST['sitetitle'], $row['otsikko']);
                    $siteTitle_url = str_replace(' ', '_', $siteTitle);
                    $siteImagePath = setImage($_FILES['siteimage']['name'], $siteName_url, $siteTitle_url, $row['teemakuva']);

                    $IDs = explode(";", $row['sisalto_id']);
                    for ($j = 1; $j < count($IDs); $j++) {
                        $selectContent = "SELECT id, alaotsikko, teksti, kuva FROM sisalto";
                        $contentResult = mysqli_query($conn, $selectContent);
                        if (mysqli_num_rows($contentResult) > 0) {
                            for ($k = 0; $k < mysqli_num_rows($contentResult); $k++) {
                                $rowFromContent = mysqli_fetch_assoc($contentResult);
                                if ($IDs[$j-1] == $rowFromContent['id']) {
                                    $siteSubTitle = setValue($_POST["subtitle$j"], $row['alaotsikko']);
                                    $siteSubtext = setValue($_POST["subtext$j"], $row['teksti']);

                                    // Send content to database
                                }
                            }
                        }
                    }
                    // rename php file for site
                    rename($row['nimiurl'], $siteName_url_db);
                    // Send site to database
                    $siteData = "UPDATE sivut SET 
                                    nimi = '$siteName',
                                    nimiurl = '$siteName_url_db',
                                    otsikko = '$siteTitle',
                                    teemakuva = '$siteImagePath'
                                WHERE id=$row[id]";
                    if (mysqli_query($conn, $siteData)) {
                        echo "<script>
                            alert('Sivu on päivitetty.');
                            window.location.href = 'user-page.php';
                        </script>";
                    }
                }
            }
        }
    }
    function setValue($post, $dbvalue) {
        if ($post == "") {
            $send = $dbvalue;
        } else {
            $send = $post;
        }
        // returns variable that will be sent to database
        return $send;
    }
    function setImage($file, $sitename_url, $title_url, $dbvalue) {
        if ($file == "") {
            $send = $dbvalue;
        } else {
            // if new image then download it
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            $siteImagePath = "img/unsplash_images/".$sitename_url."_".$title_url.".".$ext;
            if (move_uploaded_file($file, $send)) {
                $send = $siteImagePath;
            }
        }
        return $send;
    }
?>