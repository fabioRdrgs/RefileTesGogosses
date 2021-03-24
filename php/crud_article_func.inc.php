<?php
require './php/sql.inc.php';
//SQL
//************************************************************* */
/**
 * Lis les informations correspondant à l'id article fournit
 *
 * @param int $idArticle
 * @return Array|false Si un article a été trouvé: renvoie l'article sous forme d'un array, sinon renvoie false
 */
function ReadArticleById($idArticle)
{
    static $ps = null;
    $sql = @"SELECT t_annonce.id as 'idArticle', nom as 'nomArticle'
     , prix as 'prixArticle',
      quantite as 'quantiteArticle', 
      description as 'descriptionArticle', 
      nomImage as 'nomImageArticle', typeImage as 
      'typeImageArticle', idUser as 'idUser'
      FROM t_annonce JOIN t_image on (`idAnnonce` = t_annonce.id) JOIN t_user on (t_user.id = t_annonce.idUser) where t_annonce.id = :IDARTICLE";
  
    if ($ps == null) {
      $ps = db()->prepare($sql);
    }
    $answer = false;
    try {
      $ps->bindParam(':IDARTICLE', $idArticle, PDO::PARAM_INT);
  
      if ($ps->execute())
        $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  
    return $answer;
}
/**
 * Effectue une recherche d'article par rapport à la recherche fournie
 *
 * @param string $search
 * @return Array|false Renvoie un array si des articles correspondent à la recherche, sinon renvoie false
 */
function recherche($search)
{
  static $ps = null;
$search = "%".$search."%";
  $sql = "SELECT * FROM t_annonce JOIN t_image on (`idAnnonce` = t_annonce.id) WHERE nom LIKE :search LIMIT 6";

  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
$answer=false;
  try {
    $ps->bindParam(':search',$search , PDO::PARAM_STR);
   

  if($answer = $ps->execute())
  $answer = $ps->fetchAll(PDO::FETCH_ASSOC);

  } catch (PDOException $e) {
    echo $e->getMessage();
  }
return $answer;
}
/**
 * Permet de créer un nouvel article
 *
 * @param string $titreArticle
 * @param int $quantiteArticle
 * @param string $descriptionArticle
 * @param int $prixArticle
 * @param Array $arrayImages
 * @param int $idUser
 * @return bool Renvoie true si l'article a bien été crée, sinon renvoie false
 */
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
/**
 * Permet de mettre à jour un article avec des nouvelles informations
 *
 * @param string $titreArticle
 * @param int $quantiteArticle
 * @param string $descriptionArticle
 * @param int $prixArticle
 * @param Array $arrayImages
 * @param int $idArticle
 * @return bool Renvoie true si l'article a bien été mis à jour, sinon renvoie false
 */
function UpdateArticle($titreArticle, $quantiteArticle, $descriptionArticle, $prixArticle, $arrayImages,$idArticle)
{
  static $psUpdateAnnonce = null;
  static $psAddImageAnnonce = null;
  static $psDeleteImage = null;
    $sql = "UPDATE `t_annonce` SET ";
    $sql .= "`nom` = :NOM, ";
    $sql .= "`quantite` = :QUANTITE, ";
    $sql .= "`description` = :DESCRIPTION, ";
    $sql .= "`prix` = :PRIX ";
    $sql .= "WHERE (`id` = :ID)";
    $sqlDeleteImage = "DELETE * FROM t_image WHERE idAnnonce = :IDANNONCE";
    $sqlAddImage = "INSERT INTO `table` (`nomImage`, `typeImage`, `idAnnonce`) VALUES (:NOMIMAGE, :TYPEIMAGE, :IDANNONCE)";

    if ($psUpdateAnnonce == null) {
      $psUpdateAnnonce = db()->prepare($sql);
    }
    if ($psAddImageAnnonce == null) {
        $psAddImageAnnonce = db()->prepare($sqlAddImage);
      }
      if($psDeleteImage == null)
      {
        $psDeleteImage = db()->prepare($sqlDeleteImage);
      }

try{
        db()->beginTransaction();
        $psUpdateAnnonce->bindParam(':NOM', $titreArticle, PDO::PARAM_STR);
        $psUpdateAnnonce->bindParam(':QUANTITE', $quantiteArticle, PDO::PARAM_INT);
        $psUpdateAnnonce->bindParam(':DESCRIPTION', $descriptionArticle, PDO::PARAM_STR);
        $psUpdateAnnonce->bindParam(':PRIX', $prixArticle, PDO::PARAM_INT);
        $psUpdateAnnonce->bindParam(':ID', $idArticle, PDO::PARAM_INT);
        $psUpdateAnnonce->execute();

        $psDeleteImage->bindParam(':IDANNONCE',$idArticle,PDO::PARAM_INT);
        $psDeleteImage->execute();

    

        foreach($arrayImages as $img)
        {   
            $psAddImageAnnonce->bindParam(':NOMIMAGE',$img[0],PDO::PARAM_STR);
            $psAddImageAnnonce->bindParam(':TYPEIMAGE',$img[1],PDO::PARAM_STR);
            $psAddImageAnnonce->bindParam(':IDANNONCE',$idArticle,PDO::PARAM_INT);
            $psAddImageAnnonce->execute();
        }

        db()->commit();

        return true;
    }
     catch (PDOException $e) {
      db()->rollBack();
    return $e;

}
}
/**
 * Affiche les articles résultant d'une recherche d'article
 *
 * @param array<array> $articles array d'articles
 * @return void
 */
function afficherArticlesRecherche($articles)
{
  echo "<div class=\"row justify-content-center pt-2\">";

        //Affiche les articles en rapport avec la recherche effectuée 
        for ($i = 0; $i < count($articles); $i++) 
        {
            if ($i == 3 && count($articles) > 3) 
            {
                echo "</div>";
                echo "<div class=\"card-group col-11\">";
            }
            if ($i == 0)
                echo "<div class=\"card-group col-11\">";
            echo "
             <div class=\"card m-2\">
            <a href=\"./article.php?idA=" . $articles[$i]['id'] . "\">
            <img class=\"card-img-top\" src=\"tmp/". $articles[$i]['nomImage'].".". $articles[$i]['typeImage']."\" alt=\"#\">
            </a>
            <div class=\"card-body\">
            <h5 class=\"card-title\">" . $articles[$i]['nom'] . "</h5>
            <p class=\"card-text\">" . $articles[$i]['description'] . "</p>
            <p class=\"card-text\"><small class=\"text-muted\">Annonce créée le ".$articles[$i]['dateCreation']."</small></p>
            </div>
            </div>";
        }
        if (count($articles) > 3&& $i== 3)
            echo " </div>";
  echo"</div>";
}