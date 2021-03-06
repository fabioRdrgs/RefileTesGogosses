<?php
require './php/crud_article_func.inc.php';
include_once('./php/nav.inc.php');

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggedIn']))
    $_SESSION['loggedIn'] = false;


$titreArticle = filter_input(INPUT_POST, "titreArticle", FILTER_SANITIZE_STRING);
$quantiteArticle = filter_input(INPUT_POST, "quantiteArticle", FILTER_SANITIZE_NUMBER_INT);
$descriptionArticle = filter_input(INPUT_POST, "descArticle", FILTER_SANITIZE_STRING);
$prixArticle = filter_input(INPUT_POST, 'prixArticle', FILTER_SANITIZE_STRING);
//Si on essaie d'accéder à la page sans avoir cliqué au préalable sur un article ou entré un id d'article, affiche une page vide
if (!isset($_GET['idA'])) {
    die("Veuillez sélectionner un article");
}
//Sinon, récupère les informations en rapport avev l'article
else {
    $infoArticle = ReadArticleById($_GET['idA']);
    //var_dump($_SESSION);
    //var_dump($_GET['idA']);
    //var_dump($infoArticle);

    if (isset($_POST['cancelUpdate'])) {
        unset($_POST['modifyA']);
    } else if (isset($_POST['submitUpdate'])) {

        //Si une des informations n'est pas similaire à une des infos existantes, une modification à été effectuée sur l'article
        if ($titreArticle != $infoArticle[0]['nomArticle'] || $quantiteArticle != $infoArticle[0]['quantiteArticle'] || $prixArticle != $infoArticle[0]['prixArticle'] || $infoArticle[0]['descriptionArticle'] != $descriptionArticle) {

            var_dump($_FILES['imgSelect']);
            //Si des images ont été séléctionnées autre que les existantes
            if ($_FILES['imgSelect']['error'][0] == 0) {
                //Parcourt les images fournies
                for ($i = 0; $i < count($_FILES['imgSelect']['name']); $i++) {
                    $Orgfilename = $_FILES["imgSelect"]["name"][$i];
                    $filename = uniqid();
                    $ext = explode("/", $_FILES["imgSelect"]["type"][$i])[1];
                    $dir = "./tmp/";
                    $file = $filename . '.' . $ext;
                    //Affiche une erreur si trop d'images ont été sélectionnées
                    if (count($_FILES['imgSelect']['name']) > 4) {
                        echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Attention vous avez sélectionné trop de fichiers!</div>";
                        return;
                    } else {
                        //S'assure que l'image fournie est du bon format
                        if (in_array($ext, ["png", "bmp", "jpg", "jpeg", "gif"])) {
                            //S'assure que tous les champs sont remplis
                            if ($titreArticle == "" || $quantiteArticle == "" || $descriptionArticle == "" || $prixArticle == "") {
                                echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tous les champs !</div>";
                                return;
                            } else {
                                array_push($imgArray, [$filename, $ext]);
                            }
                        } else {
                            echo "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez sélectionner uniquement des images !</div>";
                            return;
                        }
                    }
                }
            } else {
                echo "Pas d'images sélectionnées";
                foreach ($infoArticle as $img) {
                    array_push($imgArray, [$img['nomImageArticle'], $img['typeImageArticle']]);
                }
            }

            //S'assure que la MàJ de l'article fonctionne
            if (UpdateArticle($titreArticle, $quantiteArticle, $descriptionArticle, $prixArticle, $imgArray, $_GET['idA'])) {
                if ($_FILES['imgSelect']['error'][0] == 0) {
                    foreach ($imgArray as $img) {
                        //Effectue l'upload des images sur le serveur en les déplaçant hors du cache du serveur
                        if (move_uploaded_file($_FILES["imgSelect"]["tmp_name"][$i], $dir . $img[0] . "." . $img[1])) {
                            echo "Upload was successful";
                            unset($resultArticleCreation);
                            unset($titreArticle);
                            unset($quantiteArticle);
                            unset($descriptionArticle);
                            unset($prixArticle);
                            unset($imgArray);
                            unset($_POST);
                        } else {
                            echo "Erreur lors de l'upload des fichiers";
                        }
                        $i++;
                    }
                }
            }
        }
    }

    //S'assure qu'un id article est présent et que l'utilisateur l'ayant crée est celui qui cherche à modifier l'article
    if (isset($_GET['idA']) && $infoArticle[0]['idUser'] == $_SESSION['user']['id'] && isset($_POST['modifyA'])) {
        echo " 
            <form method=\"POST\" action=\"annonce.php?idA=" . $_GET['idA'] . "\" enctype=\"multipart/form-data\"/>
            <label for=\"tArt\">Titre de votre article</label>
            <input type=\"text\" name=\"titreArticle\" id=\"tArt\" value=\"" . $infoArticle[0]['nomArticle'] . "\"/>
            <label for=\"qArt\">Quantité</label>
            <input type=\"number\" name=\"quantiteArticle\" id=\"qArt\" value=\"" . $infoArticle[0]['quantiteArticle'] . "\"/>
            <label for=\"pArt\">Prix</label>
            <input type=\"number\" name=\"prixArticle\" id=\"pArt\" value=\"" . $infoArticle[0]['prixArticle'] . "\"/>
            <label for=\"dArt\">Description</label>
            <textarea name=\"descArticle\" id=\"dArt\">";
        echo $infoArticle[0]['descriptionArticle'];
        echo "</textarea> 
            <label for=\"fileSelect\"> Sélectionnez 1 à 4 images de l'article :</label> 
            <input id=\"fileSelect\" accept=\".jpg, .jpeg, .png\" type=\"file\" name=\"imgSelect[]\" multiple>
            <input type=\"submit\" name=\"submitUpdate\" id=\"submit\" value=\"Modifier\"/>
            <input type=\"submit\" name=\"cancelUpdate\" id=\"cancel\" value=\"Annuler\"/>
            </form>";
    }
    //Sinon, affiche les informations concernant l'article
    else {
        $b = "<form method=\"POST\" action=\"annonce.php?idA=" . $_GET['idA'] . "\" />";
        foreach ($infoArticle as $img) {
            $b .=   "<img style=\"width:300px;height:300px;\" src=\"tmp/" . $img['nomImageArticle'] . '.' . $img['typeImageArticle'] . "\" >";
        }

        $btn = "<input disabled type=\"submit\" name=\"modifyA\" value=\"Modifier l'article\" id=\"submit\"/> </form>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Article</title>
    <style>
        #Description {
            float: left;
            height: 28.5vh;
            width: 47%;
            padding: 5px;
            border: grey solid 2px;
        }

        #article {
            margin-left: 50%;
            width: 47%;
        }

        #img {
            padding: 5px;
            border-top: grey solid 2px;
            border-left: grey solid 2px;
            border-right: grey solid 2px;
        }

        #info {
            padding: 5px;
            border: grey solid 2px;
        }

        #submit {
            float: left;
        }

        #btn {
            float: right;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>
    <div class="container-fluid">
        <h2><?= $infoArticle[0]['nomArticle'] ?></h2>
        <div id="Description">
            <?= $infoArticle[0]['descriptionArticle'] ?>
        </div>
        <div id="article">
            <div id="img">
                <?= $b ?>
            </div>
            <div id="info">
                Quantité : <?= $infoArticle[0]['quantiteArticle'] ?>
                </br>
                Prix : <?= $infoArticle[0]['prixArticle'] ?> CHF
            </div>
            </br>
            <?= $btn ?>
            <form method="POST" action="" />
            <input type="submit" id="btn" name="ajouter" value="Ajouter au panier" />
            </form>
        </div>
    </div>
</body>

<!-- Pied de page -->
<?php include_once('./php/footer.inc.php'); ?>

</html>