<?php
require_once './php/login_func.inc.php';
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
if ($script != 'index' && $_SESSION['loggedIn']) {
header('location: index.php');
die("You are not authorized for this page!");
}

var_dump($_SESSION);
$uEmail = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
$uPswd = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);

if(isset($_POST['submit']))
{
    if(checkIfEmailExists($uEmail))
    {
        $userInfo = getUserInfo($uEmail);
var_dump($userInfo);
        if(password_verify($uPswd,$userInfo['mdp']))
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user']['name'] = $userInfo['nomUtilisateur'];
            $_SESSION['user']['id'] = $userInfo['id'];
            $_SESSION['user']['email'] = $userInfo['email'];
            unset($userInfo);
            unset($uPswd);
            header('location: ./index.php');
        }else
        echo "Mot de Passe invalide!";
        
    }
    else
    echo "Cet email n'existe pas!";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Barre de navigation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body class="text-center p-5">
<div class="container-fluid p-5">
    <form class="form-signin p-5" action="login.php" method="POST">
      <img class="mb-4" src="./img/icon.png" alt="Icone" width="75" height="75">
      <h1 class="h3 mb-3 font-weight-normal">Connectez-vous</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" name="email" id="inputEmail" class="form-control mb-1" placeholder="Email" required autofocus>
      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>
      <input name="submit" value="Se connecter" class="btn btn-lg btn-primary btn-block mt-3" type="submit">
      <a href="signup.php"><p class="mt-2">Pas de compte? Inscrivez-vous</p></a>
      <p class="mt-3 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    </div>
  </body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

</html>
