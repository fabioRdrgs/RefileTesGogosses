<?php
require_once './php/crud_article_func.inc.php';
$articles = [];

$recherche = filter_input(INPUT_POST, 'recherche', FILTER_SANITIZE_STRING);
//Si une recherche a été effectuée, récupère les articles ressortant de la recherche
if (isset($recherche)) {
    $articles = recherche($recherche);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Annonces</title>
    <style>
        #sidebar {
            width: 25%;
            height: 80vh;
            padding: 10px;
            float: left;
            margin: 0;
            background-color: whitesmoke;
        }

        #range {
            width: 100%;
        }

        #content {
            margin-left: 27%;
        }
    </style>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>
    <div style="text-align: center;">
        <img src="./img/background.png" alt="Icone" width="100%" height="120">
    </div>
    <section id="sidebar">
        <form action="annonces.php" method="POST">
            <div class="form-group">
                <input type="text" class="form-control" name="recherche" placeholder="Recherche ...">
            </div>
            <p>Catégories</p>
            <div class="form-group">
                <select class="form-control" name="categories">
                    <option hidden> Séléctionnez une catégorie</option>
                    <option>Mode</option>
                    <option>Multimédia</option>
                    <option>Véhicules</option>
                    <option>Alimentaire</option>
                    <option>Mobilier</option>
                </select>
            </div>
            <div class="range">
                <p>Prix</p>
                <input type="range" class="form-range" min="0" max="100" id="range" value="0" oninput="this.form.amountInput.value=this.value" />
                <input type="number" name="amountInput" min="0" max="100" value="0" oninput="this.form.amountRange.value=this.value" disabled />
            </div>
            </br>
            <input type="submit" name="RechercheSimple" class="btn btn-light" value="Filtrer">
    </section>
    <section id="content">
        <?php AfficherArticlesRecherche($articles); ?>
    </section>
</body>

<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>

</html>