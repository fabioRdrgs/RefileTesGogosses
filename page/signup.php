<?php

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