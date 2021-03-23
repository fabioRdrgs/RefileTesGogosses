<?php

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['loggedIn']))
    $_SESSION['loggedIn'] = false;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Barre de navigation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body style="font-family: Arial, Helvetica, sans-serif;">
    <nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #EEEEEF;">
        <img src="./img/icon.png" alt="Icone" width="50" height="50">
        <a class="navbar-brand" href="index.php">Refile tes Gogosses</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <div class="navbar-collapse collapse justify-content-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Accueil<span class="sr-only">(current)</span></a>
                    </li>
                    <?php
                    if ($_SESSION["loggedIn"] == true) {
                        echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"annonces.php\">Annonces</a> </li>";
                    }else{
                        echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"login.php\">Annonces</a> </li>";
                    }
                    ?>
                    <?php
                    if ($_SESSION["loggedIn"] == true) {
                        echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"newArticle.php\">Nouvelle annonce</a> </li>";
                    }
                    ?>
                </ul>
            </div>
            <ul class="navbar-nav">
                <?php
                if ($_SESSION["loggedIn"] != true) {
                    echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"login.php\">Se connecter</a> </li>";
                }else{
                    echo "<li class=\"nav-item\"> <a class=\"nav-link\">Se deconnecter</a> </li>";
                }
                ?>
                <?php
                if ($_SESSION["loggedIn"] != true) {
                    echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"login.php\"><img src=\"./img/cart.svg\"></img></a> </li>";
                }else{
                    echo "<li class=\"nav-item\"> <a class=\"nav-link\" href=\"panier.php\"><img src=\"./img/cart.svg\"></img></a> </li>";
                }
                ?>
            </ul>
        </div>
    </nav>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>