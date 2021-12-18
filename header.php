<?php
    $indexClass = "";
    $tempClass = "";
    $loginClass = "";
    switch (basename($_SERVER['PHP_SELF'])) {
        case 'index.php':
            $indexClass = "active";
            break;
        case 'template.php':
            $tempClass = "active";
            break;
        case "login.php":
            $loginClass = "active";
            break;
    }
    echo '
        <div class="float-container" id="top">
            <header>
                <img src="img/logo/Logo light.png" alt="Company logo">
            </header>
            <nav>
                <ul>
                    <a href="index.php" class='.$indexClass.'><li class='.$indexClass.'>Etusivu</li></a>
                    <a href="template.php" class='.$tempClass.'><li class='.$tempClass.'>Esimerkkisivu</li></a>
                    <a href="login.php" id="loginBtn"><li>Kirjaudu</li></a>
                </ul>
            </nav>
        </div>
    ';
?>