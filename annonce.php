<?php

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Annonce</title>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>
    <div style="text-align: center;">
        <img src="./img/background.png" alt="Icone" width="100%" height="120">
    </div>
    <div class="container-fluid">
        </br>
        <button type="button" onclick="location.href='newArticle.php'">Ajouter un article</button>
    </div>
</body>

<!-- Pied de page -->
<?php include_once('./php/footer.inc.php'); ?>

</html>