<?php 
require './php/crud_article_func.inc.php';
if(!isset($_SESSION))
{
session_start();
}

if(!isset($_SESSION['loggedIn']))
$_SESSION['loggedIn'] = false;

// Nom de la page chargée (sans l'extension)
$script = basename($_SERVER['SCRIPT_NAME'], '.php');
// Vérifier si elle est dans la liste des droits.
// Toujours permettre l'accès à index
if ( $script != 'index'&& $script != 'annonce' && !$_SESSION['loggedIn']) {
header('location: index.php');
die("You are not authorized for this page!");
}
 
$titreArticle = filter_input(INPUT_POST, "titreArticle", FILTER_SANITIZE_STRING);
$quantiteArticle = filter_input(INPUT_POST, "quantiteArticle", FILTER_SANITIZE_NUMBER_INT);
$descriptionArticle = filter_input(INPUT_POST, "descArticle", FILTER_SANITIZE_STRING);
$prixArticle = filter_input(INPUT_POST,'prixArticle',FILTER_SANITIZE_STRING);
$imgArray = [];

if (isset($_POST['submit']))
{
    //S'assure qu'une image est bien fournie 
    if($_FILES["imgSelect"]['error'][0] == 0)
    {
        //Va parcourir l'ensemble des images fournies afin de les traiter
        for ($i = 0; $i < count($_FILES['imgSelect']['name']); $i++) 
        {
            $Orgfilename = $_FILES["imgSelect"]["name"][$i];
            $filename = uniqid();
            $ext = explode("/", $_FILES["imgSelect"]["type"][$i])[1];
            $dir = "./tmp/";
            $file = $filename.'.'.$ext;
            //S'asure que le total d'images n'excède pas 4, sinon affiche une erreur
            if (count($_FILES['imgSelect']['name']) > 4) {
                echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Attention vous avez sélectionné trop de fichiers!</div>";
                return;
            } 
            else 
            {
                //S'assure que le format de l'image est valide
                if (in_array($ext, ["png", "bmp", "jpg", "jpeg", "gif"])) 
                {
                    if($titreArticle == "" || $quantiteArticle == "" || $descriptionArticle == "" || $prixArticle == "")
                    {
                    echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tous les champs !</div>";
                    return;
                    }
                    else
                    {
                        //Affiche un message d'erreure si rien n'a été push dans l'array
                    if(array_push($imgArray,[$filename,$ext]) <= 0)
                        echo "Erreur ";
                    }               
                } 
                else 
                {
                    echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez sélectionner uniquement des images !</div>";
                    return;
                }
            }
        }
    }
    else
   echo "Veuillez sélectionner une image pour votre article";
   //Ne s'exécute que si des images ont été fournies
    if(!empty($imgArray))
    {
        //Teste si un novuel article a bel et bien été crée et va procéder à l'upload de l'image sur le serveur 
        if(CreateNewArticle($titreArticle,$quantiteArticle,$descriptionArticle,$prixArticle,$imgArray,$_SESSION['user']['id']))
        {
            for($i = 0; $i < count($_FILES['imgSelect']['name']);$i++)
            {
                //Effectue l'upload des images sur le serveur en les déplaçant hors du cache du serveur
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
    else
    echo "Aucune image n'a été fournie";
}
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
