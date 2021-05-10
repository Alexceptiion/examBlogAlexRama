<?php
require "connect.php";
require "helpers.php";

$stmt = $db->query("SELECT * from article");
$blog = $stmt->fetchAll();
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
        <div class="d-flex justify-content-between mt-3 mb-3">
            <h1>Liste d'articles</h1>
            <a class="btn btn-primary d-flex align-items-center" href="formulaire.php" id="btncreer"> Créer</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Date création</th>
                    <th>Statue</th>
                    <th>Catégorie</th>
                    <th>Tags</th>
                </tr>
            </thead>
            <?php foreach($blog as $article){ ?>
                <tr>
                    <td><?= $article["titreArticle"] ?></td>
                    <td><?= afficheDateFR($article["dateCreationArticle"]) ?></td>
                    <td><?= $article["statutArticle"] ?></td>
                    <td><?= $article["idCategorie"] ?></td>
                    <td></td>
                    <td>
                    <a href="modify.php?id=<?= $article["idArticle"] ?>">Modifier</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
<html>