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

        
if (isset($_POST['submit']))
{
    var_dump($_FILES["imgSelect"]);
    for ($i = 0; $i < count($_FILES['imgSelect']['name']); $i++) 
    {
        $Orgfilename = $_FILES["imgSelect"]["name"][$i];
        $filename = uniqid();
        $ext = explode("/", $_FILES["imgSelect"]["type"][$i])[1];
        $dir = "../tmp/";
        $file = $filename.'.'.$ext;
     

        if (count($_FILES['imgSelect']['name']) > 4) {
            echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Attention vous avez sélectionné trop de fichiers!</div>";
            return;
        } 
        else 
        {
            var_dump($ext);
            if (in_array($ext, ["png", "bmp", "jpg", "jpeg", "gif"])) 
            {
                if($titreArticle == "" || $quantiteArticle == "" || $descriptionArticle == "" || $prixArticle == "")
                {
                echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tous les champs !</div>";
                return;
                }
                else
                {
                   if(array_push($imgArray,[$filename,$ext]) <= 0)
                    echo "Erreur";
                }               
            } 
            else 
            {
                echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez sélectionner uniquement des images !</div>";
                return;
            }
        }
    }

    if(!empty($imgArray))
    {
        $resultArticleCreation = CreateNewArticle($titreArticle,$quantiteArticle,$descriptionArticle,$prixArticle,$imgArray,$_SESSION['user']['id']);   
        var_dump($resultArticleCreation);

        if($resultArticleCreation != false)
        {
            for($i = 0; $i < count($_FILES['imgSelect']['name']);$i++)
            {
                if(move_uploaded_file($_FILES["imgSelect"]["tmp_name"][$i],$dir.$file))
                {
                    echo "Upload was successful";
                    unset($resultArticleCreation);
                    unset($titreArticle);
                    unset($quantiteArticle);
                    unset($descriptionArticle);
                    unset($prixArticle);
                    unset($imgArray);
                    unset($_POST);
                }

                else
                {
                    echo "Erreur lors de l'upload des fichiers";
                }    
            }                           
        }
        else
        {
            echo $resultArticleCreation;
            return;
        } 
        unset($imgArray);               
    }
}

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
