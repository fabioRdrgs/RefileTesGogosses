<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('../php/nav.inc.php'); ?>

    <!-- Logo + Phrase d'accroche/catchy -->
    <div class="container-fluid" style="text-align: center;">
        Logo
        <br />
        Phrases d'accroche/catchy
    </div>

    <!-- Liste de quelques articles qui s'affiche selon la recherche (en dur pour le moment)-->
    <div class="card-group">
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="../img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="../img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="../img/download.svg" alt="#">
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

</html>