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
                    <a href="index.php" '.$indexClass.'><li '.$indexClass.'>Etusivu</li></a>
                    <a href="template.php" '.$tempClass.'><li '.$tempClass.'>Esimerkkisivu</li></a>
                    <a href="login.php" id="loginBtn"><li>Kirjaudu</li></a>
                </ul>
            </nav>
        </div>
    ';
?>