<?php
require './php/sql.inc.php';
//SQL
//************************************************************* */

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
function recherche($search)
{
  static $ps = null;
$search = "%".$search."%";
  $sql = "SELECT * FROM t_annonce WHERE nom LIKE :search LIMIT 6";

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
