<?php

require_once './php/crud_article_func.inc.php';
$articles = [];
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['loggedIn']))
    $_SESSION['loggedIn'] = false;

$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_STRING);
//Si une recherche a été effectuée, récupère les articles ressortant de la recherche
if (isset($search)) {
    $articles = recherche($search);
}
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
    <form action="index.php" method="POST">
        <!-- Barre de recherche (recherche simple) -->
        <div class="card p-5 ml-2 text-center">
            <div class="input-group">

                <input type="text" name="search" class="form-control" placeholder="Que recherchez-vous ?">
                <div class="input-group-append">
                    <input class="btn border border-secondary" name="RechercheSimple" src="img/search.svg" type="image"><img></img></button>
                </div>
            </div>
        </div>
    </form>

    <!-- Liste de quelques articles qui s'affiche selon la recherche (en dur pour le moment)-->
    <div class="row justify-content-center pt-2">
        <?php
        //Affiche les articles en rapport avec la recherche effectuée 
        for ($i = 0; $i < count($articles); $i++) 
        {
            if ($i == 3 && count($articles) > 3) 
            {
                echo "</div>";
                echo "<div class=\"card-group col-11\">";
            }
            if ($i == 0)
                echo "<div class=\"card-group col-11\">";
            echo "
             <div class=\"card m-2\">
            <a href=\"./annonce.php?idA=" . $articles[$i]['id'] . "\">
            <img class=\"card-img-top\" src=\"tmp/". $articles[$i]['nomImage'].".". $articles[$i]['typeImage']."\" alt=\"#\">
            </a>
            <div class=\"card-body\">
            <h5 class=\"card-title\">" . $articles[$i]['nom'] . "</h5>
            <p class=\"card-text\">" . $articles[$i]['description'] . "</p>
            <p class=\"card-text\"><small class=\"text-muted\">Annonce créée le ".$articles[$i]['dateCreation']."</small></p>
            </div>
            </div>";
        }
        if (count($articles) > 3)
            echo " </div>";
        ?>

    </div>
</body>

<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>

</html>