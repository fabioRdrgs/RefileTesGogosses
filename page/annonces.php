<?php

require '../php/crud_article_func.inc.php';
if(!isset($_SESSION))
{
session_start();
}

if(!isset($_SESSION['loggedIn']))
$_SESSION['loggedIn'] = false;


$articles = ReadArticles();
var_dump($articles);
$search = filter_input(INPUT_POST,"search",FILTER_SANITIZE_STRING);
if(isset($_POST['submit']))
{
    var_dump($search);
    var_dump(recherche($search));
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
    <form action="annonces.php" method="POST">
    <input type="text" name="search" placeholder="Chercher article par nom"/>
    <input type="submit" name="submit"/>
    </form>
    </body>
</html>
<script src=""></script>
