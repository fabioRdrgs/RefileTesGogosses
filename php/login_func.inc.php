<?php
require '../php/sql.inc.php';

function checkIfEmailExists($email)
{
  static $ps = null;
  $sql = 'SELECT email FROM t_user WHERE email = :EMAIL';

  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $email, PDO::PARAM_STR);

    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}
function getUserInfo($uEmail)
{
  static $ps = null;
  $sql = 'SELECT * FROM `t_user` WHERE email = :EMAIL';

  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':EMAIL', $uEmail, PDO::PARAM_INT);

    if ($ps->execute())
      $answer = $ps->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}
function CreateNewUser($uName,$uEmail,$uPswd)
{
  static $ps = null;
  $sql = "INSERT INTO `t_user` (`nomUtilisateur`, `email`, `mdp`) ";
  $sql .= "VALUES (:NAME, :EMAIL, :MDP)";
  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':NAME', $uName, PDO::PARAM_STR);
    $ps->bindParam(':EMAIL', $uEmail, PDO::PARAM_STR);
    $ps->bindParam(':MDP', $uPswd, PDO::PARAM_STR);
  
    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

function readById($id)
{
  static $ps = null;
  $sql = 'SELECT id, content FROM `table` WHERE id = :ID';

  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $id, PDO::PARAM_INT);

    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}
function readAll($limit = 0, $offset = 50)
{
  static $ps = null;
  $sql = 'SELECT id, content FROM `table` ORDER BY id ASC LIMIT :LIMIT,:OFFSET;';

  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':LIMIT', $limit, PDO::PARAM_INT);
    $ps->bindParam(':OFFSET', $offset, PDO::PARAM_INT);

    if ($ps->execute())
      $answer = $ps->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  return $answer;
}
function create($content1, $content2, $content3, $content4, $content5)
{
  static $ps = null;
  $sql = "INSERT INTO `table` (`content1`, `content2`, `content3`, `content4`, `content5`) ";
  $sql .= "VALUES (:CONTENT1, :CONTENT2, :CONTENT3, :CONTENT4, :CONTENT5)";
  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':CONTENT1', $content1, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT2', $content2, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT3', $content3, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT4', $content4, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT5', $content5, PDO::PARAM_STR);

    $answer = $ps->execute();
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}
function update($content1, $content2, $content3, $content4, $content5)
{
  static $ps = null;

  $sql = "UPDATE `table` SET ";
  $sql .= "`content1` = :CONTENT1, ";
  $sql .= "`content2` = :CONTENT2, ";
  $sql .= "`content3` = :CONTENT3, ";
  $sql .= "`content4` = :CONTENT4 ";
  $sql .= "WHERE (`content5` = :CONTENT5)";
  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
     $ps->bindParam(':CONTENT1', $content1, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT2', $content2, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT3', $content3, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT4', $content4, PDO::PARAM_STR);
    $ps->bindParam(':CONTENT5', $content5, PDO::PARAM_STR);
    $ps->execute();
    $answer = ($ps->rowCount() > 0);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}

/**
 * Supprime la note ave l'id $idnote.
 * @param mixed $idnote 
 * @return bool 
 */
function delete($id)
{
  static $ps = null;
  $sql = "DELETE FROM `table` WHERE (`id` = :ID);";
  if ($ps == null) {
    $ps = db()->prepare($sql);
  }
  $answer = false;
  try {
    $ps->bindParam(':ID', $id, PDO::PARAM_INT);
    $ps->execute();
    $answer = ($ps->rowCount() > 0);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }
  return $answer;
}
?>