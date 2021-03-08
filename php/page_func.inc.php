<?php
function setLinks($path)
{
    if (strpos($path, 'index.php')!== false) {
        $arrayPath = ["index.php", "page/annonces.php", "page/annonce.php", "page/signup.php", "page/login.php", "./img/cart.svg", "page/login.php"];
    } else {
        $arrayPath = ["../index.php", "annonces.php", "annonce.php", "signup.php", "login.php", "../img/cart.svg", "login.php"];
    }
    return $arrayPath;
}
