<?php
require '../php/crud_article_func.inc.php';
if(!isset($_GET['idA']))
{
    die("Veuillez sélectionner un article");
}
else
{
    if(isset($_POST['submitUpdate']))
    {
         if($titreArticle != $infoArticle['nomArticle'] || $quantiteArticle != $infoArticle['quantiteArticle'] || $prixArticle != $infoArticle['prixArticle'] || $infoArticle['descriptionArticle'] != $descriptionArticle || isset($_FILES['imgSelect']))
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
         }
    }

    $infoArticle = ReadArticleById($_GET['idA']);
    if(isset($_GET['idA']) && $infoArticle['id'] == $_SESSION['user']['id'] && isset($_POST['modifyA']))
    {
        echo " <label for=\"tArt\">Titre de votre article</label>
        <input type=\"text\" name=\"titreArticle\" id=\"tArt\" value=\"".$infoArticle['nomArticle']."\"/>
        <label for=\"qArt\">Quantité</label>
        <input type=\"number\" name=\"quantiteArticle\" id=\"qArt\" value=\"".$infoArticle['quantiteArticle']."\"/>
        <label for=\"pArt\">Prix</label>
        <input type=\"number\" name=\"prixArticle\" id=\"pArt\" value=\"".$infoArticle['prixArticle']."\"/>
        <label for=\"dArt\">Description</label>
        <textarea name=\"descArticle\" id=\"dArt\">
            "; echo $infoArticle['descriptionArticle']; echo"
        </textarea> 
        <label for=\"fileSelect\"> Sélectionnez 1 à 4 images de l'article :</label> 
        <input id=\"fileSelect\" accept=\".jpg, .jpeg, .png\" type=\"file\" name=\"imgSelect[]\" multiple>
        <input type=\"submit\" name=\"submitUpdate\" id=\"submit\"/>";
    }
    else
    {
        $infoArticle = ReadArticleById($_GET['idA']);

        var_dump($infoArticle);
        echo "<img style=\"width:300px;height:300px;\" src=\"../tmp/".$infoArticle['nomImageArticle'].'.'.$infoArticle['typeImageArticle']."\" >";
        echo "<input type=\"submit\" name=\"modifyA\" value=\"Modifier l'article\" id=\"submit\"/>";
    }
}
