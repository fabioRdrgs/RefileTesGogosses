<?php 
require '../php/crud_article_func.inc.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="" rel="stylesheet" type="text/css"/>  
        
        		<!-- Style & Common Css --> 
		<link rel="stylesheet" href="../css/bootstrap.min.css">

        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>     
    </head>
    <body>
        <?php

        
        ?>
        <form method="POST" action="newArticle.php" enctype="multipart/form-data">
        <label for="tArt">Titre de votre article</label>
        <input type="text" name="titreArticle" id="tArt" value="Banane"/>
        <label for="qArt">Quantité</label>
        <input type="number" name="quantiteArticle" id="qArt" value="50"/>
        <label for="pArt">Prix</label>
        <input type="number" name="prixArticle" id="pArt" value="15.50"/>
        <label for="dArt">Description</label>
        <textarea name="descArticle" id="dArt">
            Des Bananes!
        </textarea>
        <label for="fileSelect"> Sélectionnez 1 à 4 images de l'article :</label> 
        <input id="fileSelect" accept=".jpg, .jpeg, .png" type="file" name="imgSelect[]" multiple>
        <input type="submit" name="submit" id="submit"/>
        </form>
    </body>
    <script src="../js/newArticle.js"></script>
</html>
