<?php
function setLinks()
{
    $path = $_SERVER['SCRIPT_NAME'];
    if (strpos($path, 'index.php')!== false) {
        $arrayPath = ["index.php", "page/annonces.php", "page/annonce.php", "page/signup.php", "page/login.php", "./img/cart.svg"];
    } else {
        $arrayPath = ["../index.php", "annonces.php", "annonce.php", "signup.php", "login.php", "../img/cart.svg"];
    }
    return $arrayPath;
}
