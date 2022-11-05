<?php
    session_start();
    session_destroy();
    setcookie("nomeUtente", "");
    header("Location: login.php");
    exit;

?>