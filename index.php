<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>

    <!-- Logo + Phrase d'accroche/catchy -->
    <div class="container-fluid" style="text-align: center;">
        Logo
        <br />
        Phrases d'accroche/catchy
    </div>

    <!-- Barre de recherche (recherche simple) -->
    <div class="card p-5" style="text-align: center;">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Que recherchez-vous ?">
            <div class="input-group-append">
                <button class="btn border border-secondary" name="RechercheSimple" type="button"><img src="img/search.svg"></img></button>
            </div>
        </div>
    </div>

    <!-- Liste de quelques articles qui s'affiche selon la recherche (en dur pour le moment)-->
    <div class="card-group p-4">
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
    </div>
    <div class="card-group p-4">
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
        <div class="card m-2">
            <a href="page/article.php">
                <img class="card-img-top" src="img/download.svg" alt="#">
            </a>
            <div class="card-body">
                <h5 class="card-title">Titre</h5>
                <p class="card-text">Description</p>
                <p class="card-text"><small class="text-muted">Last updated X mins ago</small></p>
            </div>
        </div>
    </div>

    <!-- Pied de page (pas sûr de le garder) -->
    <footer class="bg-light text-center text-lg-start">
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Footer Content</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                        molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                        voluptatem veniam, est atque cumque eum delectus sint!
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Links</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <a href="#!" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0">Links</h5>
                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-dark">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-dark">Link 4</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright:
            <a class="text-dark" href="https://mdbootstrap.com/">MDBootstrap.com</a>
        </div>
    </footer>
</body>

</html>