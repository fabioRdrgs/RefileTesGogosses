<?php
require './php/sql.inc.php';

/**
 * Vérifie si l'email fournit existe bien dans la base de donnée
 *
 * @param string $email
 * @return Array|false Si un email existe renvoie l'email, sinon envoie false
 */
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
/**
 * Récupère les informations correspondant à l'email fournit
 *
 * @param string $uEmail
 * @return Array|false Renvoie les informations utilisateur, dans le cas échéant renvoie false.
 */
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
/**
 * Crée un nouvel utilisateur
 *
 * @param string $uName
 * @param string $uEmail
 * @param string $uPswd
 * @return bool Renvoie true si l'utilisateur a été crée, sinon renvoie false
 */
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
?>