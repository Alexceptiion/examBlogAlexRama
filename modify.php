<?php
require "connect.php";
require "helpers.php";

if(!existGET("idArticle")){
    redirectTo("formulaire.php");
}
$id = $_GET["idArticle"];
$errors = [];

//Vérifier et obtenir la ligne de base de données
$stmt = $db->prepare("SELECT * FROM blog WHERE id=idArticle");

$article = null;
if($stmt->execute([$id])){
    $article = $stmt->fetch();
}else{
    $errors[] = "C'est vachement pas sympas SUR 20";
}

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["modify"])){

    }
}
?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créeer un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
</head>
<body>

    <!---------------------------------------->
      <div class="container d-flex flex-column align-items-center">
        <h1>Créer un article</h1>
        <?php foreach($errors as $error){ ?>
            <div class="alert alert-warning">
                <?= $error ?>
            </div>
        <?php } ?>
        <div class="card p-4 w-50">
            <form method="POST">
            <!--titre article-->
                <div class="mb">
                    <input type="text" placeholder="Titre de l'article" name="titreArticle">   
                </div>
                <!--Contenu-->
                <!-- <div>
                    <textarea name="contenuArticle" id="" cols="30" rows="10"></textarea>
                </div> -->

                <!--categorie-->
                <div>
                    <label for="">Categorie</label><br/>
                    <select name="idCategorie" id="">
                        <option value="">Choisir une categorie</option>
                        <option>Cake</option>
                        <option>SpaceCake</option>
                        <option>Sweets</option>
                        <option>Lolipop</option>
                    </select>
                </div>

                 <!--Tag-->
                 <div>
                    <label for="">Tags</label><br/>
                    <select name="idTag" id="">
                        <option value="">Choisir un Tag</option>
                        <option>Jelly</option>
                        <option>Fudge</option>
                        <option>Sugar</option>
                        <option>Fruits</option>
                    </select>
                </div>    
               
               <div>
                <button type="submit" class="mt-3 btn btn-primary">Publier</button>
                <button type="submit" class="mt-3 btn btn-primary">Sauvegarder</button>
               </div> 

            </form>
        </div>
    </div>
</body>
</html>
