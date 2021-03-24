<?php
require './php/crud_article_func.inc.php';
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['loggedIn']))
    $_SESSION['loggedIn'] = false;

// Nom de la page chargée (sans l'extension)
$script = basename($_SERVER['SCRIPT_NAME'], '.php');
// Vérifier si elle est dans la liste des droits.
// Toujours permettre l'accès à index
if ($script != 'index' && $script != 'annonce' && !$_SESSION['loggedIn']) {
    header('location: index.php');
    die("You are not authorized for this page!");
}
$msg = "";
$titreArticle = filter_input(INPUT_POST, "titreArticle", FILTER_SANITIZE_STRING);
$quantiteArticle = filter_input(INPUT_POST, "quantiteArticle", FILTER_SANITIZE_NUMBER_INT);
$descriptionArticle = filter_input(INPUT_POST, "descArticle", FILTER_SANITIZE_STRING);
$prixArticle = filter_input(INPUT_POST, 'prixArticle', FILTER_SANITIZE_STRING);
$imgArray = [];

if (isset($_POST['submit'])) {
    if (!isset($titreArticle) && !isset($quantiteArticle) && !isset($descriptionArticle) && !isset($prixArticle)) {
        //S'assure qu'une image est bien fournie 
        if ($_FILES["imgSelect"]['error'][0] == 0) {
            //Va parcourir l'ensemble des images fournies afin de les traiter
            for ($i = 0; $i < count($_FILES['imgSelect']['name']); $i++) {
                $Orgfilename = $_FILES["imgSelect"]["name"][$i];
                $filename = uniqid();
                $ext = explode("/", $_FILES["imgSelect"]["type"][$i])[1];
                $dir = "./tmp/";
                $file = $filename . '.' . $ext;
                //S'assure que le total d'images n'excède pas 4, sinon affiche une erreur
                if (count($_FILES['imgSelect']['name']) > 4) {
                    $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Attention vous avez sélectionné trop de fichiers!</div>";
                    return;
                } else {
                    //S'assure que le format de l'image est valide
                    if (in_array($ext, ["png", "bmp", "jpg", "jpeg", "gif"])) {
                        if ($titreArticle == "" || $quantiteArticle == "" || $descriptionArticle == "" || $prixArticle == "") {
                            $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tous les champs !</div>";
                            return;
                        } else {
                            //Affiche un message d'erreure si rien n'a été push dans l'array
                            if (array_push($imgArray, [$filename, $ext]) <= 0)
                                $msg = "Erreur ";
                        }
                    } else {
                        $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez sélectionner uniquement des images !</div>";
                        return;
                    }
                }
            }
        } else
            $msg = "Veuillez sélectionner une image pour votre article";
    } else {
        $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Veuillez remplir tous les champs !</div>";
    }

    //Ne s'exécute que si des images ont été fournies
    if (!empty($imgArray)) {
        //Teste si un novuel article a bel et bien été crée et va procéder à l'upload de l'image sur le serveur 
        if (CreateNewArticle($titreArticle, $quantiteArticle, $descriptionArticle, $prixArticle, $imgArray, $_SESSION['user']['id'])) {
            for ($i = 0; $i < count($_FILES['imgSelect']['name']); $i++) {
                //Effectue l'upload des images sur le serveur en les déplaçant hors du cache du serveur
                if (move_uploaded_file($_FILES["imgSelect"]["tmp_name"][$i], $dir . $file)) {
                    $msg = "Upload was successful";
                    unset($resultArticleCreation);
                    unset($titreArticle);
                    unset($quantiteArticle);
                    unset($descriptionArticle);
                    unset($prixArticle);
                    unset($imgArray);
                    unset($_POST);
                    header('location: ./index.php');
                } else {
                    $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Erreur lors de l'upload des fichiers !</div>";
                }
            }
        } else {
            echo $resultArticleCreation;
            return;
        }
        unset($imgArray);
    } else
        $msg = "<div id=\"errorDiv\" class=\"alert alert-danger\" role=\"alert\">Aucune image n'a été fournie !</div>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Nouvel article</title>
    <style>
        #lbl {
            display: inline-block;
            width: 35%;
            font-variant: small-caps;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php
    include_once('php/nav.inc.php');
    echo $msg;
    ?>
    <div class="container-fluid">
        <form method="POST" action="newArticle.php" enctype="multipart/form-data" class="pt-3">
            <div class="form-group">
                <label for="tArt" id="lbl">Titre de votre article</label>
                <input required type="text" name="titreArticle" id="tArt" value="Banane" />
            </div>
            <div class="form-group">
                <label for="qArt" id="lbl">Quantité</label>
                <input required type="number" name="quantiteArticle" id="qArt" value="50" />
            </div>
            <div class="form-group">
                <label for="pArt" id="lbl">Prix</label>
                <input required type="number" name="prixArticle" id="pArt" value="15.50" />
            </div>
            <div class="form-group">
                <label for="dArt" id="lbl">Description</label>
                <textarea required name="descArticle" id="dArt">
            Des Bananes!
            </textarea>
            </div>
            <div class="form-group">
                <label for="fileSelect" id="lbl"> Sélectionnez 1 à 4 images de l'article :</label>
                <input id="fileSelect" accept=".jpg, .jpeg, .png" type="file" name="imgSelect[]" multiple>
            </div>
            <input type="submit" name="submit" id="submit" />
        </form>
    </div>
</body>
<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>
<script src="../js/newArticle.js"></script>

</html>