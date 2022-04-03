
                <!DOCTYPE html>
                <?php
                    $siteName = 'testi';
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
            
                            <article>
                                <div class='row'>
                                    <div class='left'>
                                        <h1>esgfeg</h1>
                                        <p>agaeeggge</p>
                                    </div>
                                    <aside class='rightImg'><img src='img/unsplash_images/tekton-e6Wr8LaH-Q8-unsplash.jpg' alt=''></aside>
                                </div>
                            </article>
                    
                        </section>
                        <?php require 'footer.php'?>
                    </body>
                </html>
            