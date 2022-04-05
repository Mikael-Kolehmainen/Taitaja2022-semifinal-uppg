
                <!DOCTYPE html>
                <?php
                    $siteName = 'testi';
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
                                                            <div class='row'>
                                                                <div class='left'>
                                                                    <h1>{$row2["alaotsikko"]}</h1>
                                                                    <p>{$row2["teksti"]}</p>
                                                                </div>
                                                                <aside class='rightImg'><img src={$row2['kuva']} alt=''></aside>
                                                            </div>
                                                        </article>
                                                    ";
                                                } else {
                                                    echo "
                                                        <article>
                                                            <div class='row'>
                                                                <div class='right'>
                                                                    <h1>{$row2["alaotsikko"]}</h1>
                                                                    <p>{$row2["teksti"]}</p>
                                                                </div>
                                                                <aside class='leftImg'><img src={$row2['kuva']} alt=''></aside>
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
            
                        </section>
                        <?php require 'footer.php'?>
                    </body>
                </html>
            