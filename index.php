<?php

if(!isset($_SESSION))
{
session_start();
}
if(!isset($_SESSION['loggedIn']))
$_SESSION['loggedIn'] = false;

var_dump($_SESSION);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>

    <!-- Logo + Phrase d'accroche/catchy -->
    <div class="container-fluid" style="text-align: center;">
    <img src="<?= $lienNav[4] ?>" alt="Icone" width="50" height="50">
        <br />
        Phrases d'accroche / catchy
    </div>
    
    <!-- Barre de recherche (recherche simple) -->
    <div class="card p-5 ml-2 text-center"">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Que recherchez-vous ?">
            <div class="input-group-append">
                <button class="btn border border-secondary" name="RechercheSimple" type="button"><img src="img/search.svg"></img></button>
            </div>
        </div>
    </div>

    <!-- Liste de quelques articles qui s'affiche selon la recherche (en dur pour le moment)-->
    <div class="row justify-content-center pt-2">
        <div class="card-group col-11">
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
        </div>
        <div class="card-group col-11">
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
            <div class="card m-2">
                <a href="page/article.php">
                    <img class="card-img-top" src="img/download.svg" alt="#">
                </a>
                <div class="card-body">
                    <h5 class="card-title">Titre</h5>
                    <p class="card-text">Description</p>
                    <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>
</html>