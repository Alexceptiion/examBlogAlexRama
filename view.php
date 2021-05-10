<?php
require "connect.php";
require "helpers.php";

$id = $_GET["id"];
$errors = [];

// modify
if(isset($_GET['id'])){
    $idArticleToEdit = $_GET["id"];
    $stmt = $db->prepare("SELECT * from article WHERE idArticle = :idArticleToEdit;");
    $stmt->execute([
        ':idArticleToEdit' => $idArticleToEdit
     ]);
     $blogEdit = $stmt->fetchAll(); 
    //  print_r($blogEdit);
    
    // Récupérer les valeurs depuis la requête et les inserer dans les inputs
     $valueIdArticle = $blogEdit[0]['idArticle'];
     $valueTitre = $blogEdit[0]['titreArticle'];
     $valueArea = $blogEdit[0]['contenuArticle'];
     $valueToTestTemp = $blogEdit[0]['idCategorie'];
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        
</head>
<body>
    <header>
        <h1><?= $valueTitre ?></h1>

        <p><?= $valueArea ?></p>
    </header>
</body>
</html>