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

    <form method="POST" action="signup.php">
        <input require type="text" name="username" id="uName" />
        <input require type="email" name="email" id="uEmail" />
        <input type="password" name="password" id="uPswd" />
        <input type="password" name="passwordVerif" id="uPswdVer" />
        <input type="submit" name="register" id="register" />
    </form>
</body>

<!-- Pied de page -->
<?php include_once('../php/footer.inc.php'); ?>

</html>
<script src="../js/main.js"></script>