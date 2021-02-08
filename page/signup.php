<?php 

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
        <input require type="text" name="username" id="uName"/>
        <input require type="email" name="email" id="uEmail"/>
        <input  type="password" name="password" id="uPswd"/>
        <input  type="password" name="passwordVerif" id="uPswdVer"/>
        <input type="submit" name="register" id="register"/>
        </form>
    </body>
</html>
<script src="../js/main.js"></script>