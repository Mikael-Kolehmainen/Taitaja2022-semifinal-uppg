
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
        
                        <article>
                            <div class='row'>
                                <div class='left'>
                                    <h1>testi</h1>
                                    <p>testapfkjakfne</p>
                                </div>
                                <aside class='rightImg'><img src='img/unsplash_images/matt-artz-pH6wLT6TVFc-unsplash.jpg' alt=''></aside>
                            </div>
                        </article>
                
                    </section>
                    <?php require 'footer.php'?>
                </body>
            </html>
        