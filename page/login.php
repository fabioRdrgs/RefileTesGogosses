<?php
require_once '../php/login_func.inc.php';
if(!isset($_SESSION))
{
session_start();
}
if(!isset($_SESSION['loggedIn']))
$_SESSION['loggedIn'] = false;

var_dump($_SESSION);

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

        if(password_verify($uPswd,$userInfo['mdp']))
        {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user']['name'] = $userInfo['nomUtilisateur'];
            $_SESSION['user']['id'] = $userInfo['id'];
            $_SESSION['user']['email'] = $userInfo['email'];
            unset($userInfo);
            unset($uPswd);
            header('location: index.php');
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
        <title>Connexion</title>
        <link href="" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>     
</head>
    <body>
        <form method="POST" action="login.php">        
            <label for="uEmail">Email</label>
            <input require type="email" name="email" id="uEmail"/>
            <label for="uPswd">Password</label>
            <input require type="password" name="password" id="uPswd"/>       
            <input type="submit" name="submit" id="login"/>
        </form>
    </body>
</html>
