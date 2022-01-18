<?php
    setcookie('username', "", time() - (60 * 30), "/");
    header("Location: Login.php");
?>