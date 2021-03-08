<?php
require '../php/sql.inc.php';
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
static $imgArray = Array();

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

//SQL
//************************************************************* */

function ReadArticleById($idArticle)
{
    static $ps = null;
    $sql = @"SELECT nom as 'nomArticle'
     , prix as 'prixArticle',
      quantite as 'quantiteArticle', 
      description as 'descriptionArticle', 
      nomImage as 'nomImageArticle', typeImage as 
      'typeImageArticle', nomUtilisateur as 'nomUser'
      FROM t_annonce JOIN t_image on (`idAnnonce` = t_annonce.id) JOIN t_user on (t_user.id = t_annonce.idUser) where t_annonce.id = :IDARTICLE";
  
    if ($ps == null) {
      $ps = db()->prepare($sql);
    }
    $answer = false;
    try {
      $ps->bindParam(':IDARTICLE', $idArticle, PDO::PARAM_INT);
  
      if ($ps->execute())
        $answer = $ps->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  
    return $answer;
}

function CreateNewArticle($titreArticle, $quantiteArticle, $descriptionArticle, $prixArticle, $arrayImages, $idUser)
{

    $sqlCreateArticle = "INSERT INTO `t_annonce`(`nom`,`description`,`prix`,`quantite`,`idUser`) VALUES (:NOM, :DESCRIPTION, :PRIX, :QUANTITE, :IDUSER)";
    $sqlAddImage = "INSERT INTO `t_image` (`nomImage`,`typeImage`,`idAnnonce`) VALUES (:NOMIMAGE, :TYPEIMAGE, :IDARTICLE)";
    
      try {
        static $req = null;
        if($req == null)
        $req = db()->prepare($sqlCreateArticle);
    
        db()->beginTransaction();
        $req->bindParam(':NOM',$titreArticle,PDO::PARAM_STR);
        $req->bindParam(':DESCRIPTION',$descriptionArticle,PDO::PARAM_STR);
        $req->bindParam(':PRIX',$prixArticle,PDO::PARAM_INT);
        $req->bindParam(':QUANTITE',$quantiteArticle,PDO::PARAM_INT);
        $req->bindParam(':IDUSER',$idUser,PDO::PARAM_INT);

        $req->execute();

        $idArticle = db()->lastInsertId();
    
        static $req2 = null;
        if($req2 == null)
        $req2 = db()->prepare($sqlAddImage);
      
        foreach($arrayImages as $img)
        {   
        $req2->bindParam(':NOMIMAGE',$img[0],PDO::PARAM_STR);
        $req2->bindParam(':TYPEIMAGE',$img[1],PDO::PARAM_STR);
        $req2->bindParam(':IDARTICLE',$idArticle,PDO::PARAM_INT);
        $req2->execute();
        }

        db()->commit();

        return true;
        } catch (PDOException $e) {
          db()->rollBack();
        return $e;
        }
}

