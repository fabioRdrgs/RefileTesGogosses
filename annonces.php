<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Annonces</title>
    <style>
        #sidebar {
            width: 25%;
            height: 80vh;
            padding: 10px;
            float: left;
            margin: 0;
            background-color: whitesmoke;
        }

        #range {
            width: 100%;
        }

        #content{
            margin-left: 27%;
        }
    </style>
</head>

<body>
    <!-- Barre de nvigation -->
    <?php include_once('php/nav.inc.php'); ?>
    <div style="text-align: center;">
        <img src="./img/background.png" alt="Icone" width ="100%" height="120">
    </div>
    <section id="sidebar">
        <form method="POST" action="">
            <div class="form-group">
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Recherche ...">
            </div>
            <p>Catégories</p>
            <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option hidden> Séléctionnez une catégorie</option>
                    <option>Mode</option>
                    <option>Multimédia</option>
                    <option>Véhicules</option>
                    <option>Alimentaire</option>
                    <option>Mobilier</option>
                </select>
            </div>
            <div class="range">
                <p>Prix</p>
                <input type="range" class="form-range" min="0" max="100" id="range" value="0" oninput="this.form.amountInput.value=this.value" />
                <input type="number" name="amountInput" min="0" max="100" value="0" oninput="this.form.amountRange.value=this.value" disabled />
            </div>
            </br>
            <button type="button" class="btn btn-light">Filtrer</button>
    </section>
    <section id="content">
        Afficher les articles ici
    </section>
</body>

<!-- Pied de page -->
<?php include_once('php/footer.inc.php'); ?>

</html>