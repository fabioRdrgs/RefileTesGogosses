<?php
require '../php/crud_article_func.inc.php';
if(!isset($_GET['idA']))
{
    die("Veuillez sélectionner un article");
}
else
{
    $infoArticle = ReadArticleById($_GET['idA']);

    var_dump($infoArticle);
    echo "<img style=\"width:300px;height:300px;\" src=\"../tmp/".$infoArticle['nomImageArticle'].'.'.$infoArticle['typeImageArticle']."\" >";
}
?>