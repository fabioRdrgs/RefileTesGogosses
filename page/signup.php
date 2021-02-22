<?php 
require_once '../php/login_func.inc.php';
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
if ( $script != 'index' && $_SESSION['loggedIn']) {
header('location: index.php');
die("You are not authorized for this page!");
} 

var_dump($_SESSION);
$uName = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING);
$uEmail = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
$uPswd = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
$uPswdVer = filter_input(INPUT_POST,'passwordVerif',FILTER_SANITIZE_STRING); 

if(isset($_POST['submit']))
{
    preg_match("/^([\w\d._\-#])+@([\w\d._\-#]+[.][\w\d._\-#]+)+$/",$uEmail,$matches);
    if(strlen($uEmail) > 0 && $matches!= null && strlen($uPswd) > 6 && $uPswd == $uPswdVer){
        if(checkIfEmailExists($uEmail) == null)
        {
            $hashedPswd = password_hash($uPswd,PASSWORD_DEFAULT);
            if(CreateNewUser($uName,$uEmail,$hashedPswd))
            {
                unset($hashedPswd);
                $_SESSION['user']['name'] = $uName;
                $_SESSION['user']['email']= $uEmail;
                $_SESSION['user']['id'] = getUserInfo($uEmail)['id'];
                $_SESSION['loggedIn'] = true;
                echo "Succès!";
                unset($userInfo);
                unset($uPswd);
            }
            else
            echo "erreur lors de la création du compte";          
        }
        else
        echo "Ce mail existe déjà!";
    }
    else
    echo "Erreur?";  
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link href="" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>     
</head>
    <body>
        <form method="POST" action="signup.php">
            <label for="uName">Username</label>
            <input require type="text" name="username" id="uName"/>
            <label for="uEmail">Email</label>
            <input require type="email" name="email" id="uEmail"/>
            <label for="uPswd">Password</label>
            <input  type="password" name="password" id="uPswd"/>
            <label for="uPswdVer">Verify Password</label>
            <input  type="password" name="passwordVerif" id="uPswdVer"/>
            <input type="submit" name="submit" id="register" disabled/>
        </form>
    </body>
</html>
<script src="../js/register.js"></script>