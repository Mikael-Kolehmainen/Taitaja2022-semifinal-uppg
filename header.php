<?php
    $indexClass = "";
    $tempClass = "";
    $loginClass = "";
    switch (basename($_SERVER['PHP_SELF'])) {
        case 'index.php':
            $indexClass = "class=active";
            break;
        case 'template.php':
            $tempClass = "class=active";
            break;
        case "login.php":
            $loginClass = "class=active";
            break;
    }
    echo '
        <div class="float-container" id="top">
            <header>
                <img src="img/logo/Logo_light.png" alt="Company logo">
            </header>
            <nav>
                <div id="hamburger">
                    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                        <img src="img/icon/menu-bars.png" alt="Hamburger image" id="hamburgerImage">
                    </a>
                </div>
                <ul id="myLinks">
                    <a href="index.php" '.$indexClass.'><li '.$indexClass.'>Etusivu</li></a>';
                    // Admin added pages
                    if (isset($siteName)) {
                        $getSiteNames = mysqli_query($conn, $sql);
                        for ($j = 0; $j < mysqli_num_rows($getSiteNames); $j++) {
                            $rowForHeader = mysqli_fetch_assoc($getSiteNames);
                            echo "<a href={$rowForHeader['nimiurl']}><li>{$rowForHeader['nimi']}</li></a>";
                        }
                    } else {
                        require "connection.php";
                        $sql = "SELECT nimi, nimiurl FROM sivut";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                $row = mysqli_fetch_assoc($result);
                                echo "<a href={$row['nimiurl']}><li>{$row['nimi']}</li></a>";
                            }
                        }
                    }
                    if (strpos($_SERVER['REQUEST_URI'], '/user-page.php') == true) {
                        echo '<a href="remove-cookie.php" id="loginBtn" style="background-color: #743000"><li>Kirjaudu Ulos</li></a>';
                    } else {
                        echo '<a href="login.php" id="loginBtn"><li>Kirjaudu</li></a>';
                    }
    echo '
                </ul>
            </nav>
        </div>
    ';
?>