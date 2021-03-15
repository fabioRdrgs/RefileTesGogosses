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
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('../php/nav.inc.php'); ?>

    <div class="container-fluid">
        <form method="POST" action="signup.php" class="row row-cols-lg-auto g-2 justify-content-center">
            <h1 class="h3 mb-3 font-weight-normal mt-2">Inscrivez-vous</h1>
            <div class="input-group justify-content-center mb-1">
                <label for="inputEmail" class="mr-3">Nom d'utilisateur :</label>
                <input type="text" name="username" id="uName" class="form-control col-4" required autofocus>
            </div>
            <div class="input-group justify-content-center mb-1">
                <label for="inputEmail" class="mr-5">Email :</label>
                <input type="email" name="email" id="uEmail" class="form-control col-4 ml-5" required autofocus>
            </div>
            <div class="input-group justify-content-center mb-1">
                <label for="inputEmail" class="mr-4">Mot de passe :</label>
                <input type="password" name="password" id="uPswd" class="form-control col-4 ml-3" required autofocus>
            </div>
            <div class="input-group justify-content-center mb-2">
                <label for="inputEmail" class="mr-5">Verification :</label>
                <input type="password" name="passwordVerif" id="uPswdVer" class="form-control col-4 ml-2" required autofocus>
            </div>
            <input type="submit" name="register" class="btn btn-primary col-2" id="register" />
        </form>
    </div>
</body>

<!-- Pied de page -->
<?php include_once('../php/footer.inc.php'); ?>

</html>
<script src="../js/main.js"></script>
