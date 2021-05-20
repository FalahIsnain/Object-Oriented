<?php 
    session_start();
    session_destroy();

    if (!empty($_COOKIE['login'])) {
        setcookie('login', "", time()-3600);
    }

    header('Location:login.php')
?>