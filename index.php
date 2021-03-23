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
        <img src="./img/icon.png" alt="Icone" width="50" height="50">
        <br />
        Refile tes Gogosses de la meilleure des manières !
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

    <!-- Affiche les articles après qu'une recherche ait été effectuée -->
   <?php AfficherArticlesRecherche($articles);?>
</body>

<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>

</html>