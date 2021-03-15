<?php
function setLinks($path)
{
    if (strpos($path, 'index.php')!== false) {
        $arrayPath = ["index.php", "annonces.php", "annonce.php", "login.php", "./img/icon.png", "./img/cart.svg", "signup.php"];
    } else {
        $arrayPath = ["./index.php", "annonces.php", "annonce.php", "login.php", "./img/icon.png", "./img/cart.svg", "signup.php"];
    }
    return $arrayPath;
}
