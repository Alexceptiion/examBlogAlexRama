<?php
require "connect.php";
require "helpers.php";

$errors = [];

// On verifie que la methode post existe, si elle existe on execute la requete
 if($_SERVER["REQUEST_METHOD"] === "POST"){
     if(existPOST("titreArticle")){
        $sql = "INSERT INTO `article` 
        (titreArticle, dateCreationArticle, statutArticle, contenuArticle,  idCategorie) 
        VALUES (:titreArticle, CURDATE(), :statutArticle, 'area',
        (SELECT idCategorie FROM categorie WHERE nomCategorie = :nomCategorie))";

        $stmt = $db->prepare($sql);
        $res = $stmt->execute([
           ":titreArticle" => htmlspecialchars($_POST["titreArticle"]),
           //":contenuArticle" => htmlspecialchars($_POST["contenuArticle"]),
           //"dateCreationArticle" => $_POST["dateCreationArticle"],
           "statutArticle" => htmlspecialchars($_POST["statutArticle"]),
           ":nomCategorie" => htmlspecialchars($_POST["nomCategorie"])
           //':idTag' => htmlspecialchars($_POST["idTag"])
        ]);

    // on verifie si la reponse est vrai ou fausse
    //     if ($res=== true){
             redirectTo("index.php");
    //     }else{
    //         $errors[] = "Erreur lors de la sauvegarde des données. Veuillez réessayer plus tard";
    //     }
        }else{
            $errors[] = "Veuillez remplir tous les champs";
        }
    }

    // modify
    if(isset($_GET['id'])){
        $idArticleToEdit = $_GET["id"];
        $stmt = $db->prepare("SELECT * from article WHERE idArticle = :idArticleToEdit;");
        $stmt->execute([
            ':idArticleToEdit' => $idArticleToEdit
         ]);
         $blogEdit = $stmt->fetchAll(); 
         //print_r($blogEdit);
    }
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créeer un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!---------------------------------------->
    <div class="container d-flex flex-column align-items-center">
        <h1>Créer un article</h1><br>
        <?php foreach($errors as $error){ ?>
        <div class="alert alert-warning">
            <?= $error ?>
        </div>
        <?php } ?>
        <div class="">
            <form method="POST" class="leformulaire">
                <!--titre article-->
                <div class="mb">
                    <input type="text" placeholder="Titre de l'article" name="titreArticle">
                </div><br>
                <!--Contenu-->
                <div>
                    <textarea name="contenuArticle" id="" cols="30" rows="14"></textarea>
                </div><br>


                <div class="btnform">
                    <button type="submit" class="btn btn-outline-info"
                        id="btnpublier">Publier</button>&nbsp;&nbsp;<br><br>
                    <button type="submit" class="btn btn-outline-warning"
                        id=btnsauvegarder>Sauvegarder</button>&nbsp;&nbsp;
                </div>
        </div>

        <!--categorie-->

        <div class="form-group w-50">

            <label for="">Statut Article</label><br />
            <select id="" name="statutArticle">
                <option>Publié</option>
                <option>Brouillon</option>
                <option>Corbeille</option>
            </select>
        </div>

        <div class="deplacer">
            <div class="categorieclasse">
                <label for="">Categorie</label><br />
                <select name="nomCategorie" id="">
                    <option value="">Choisir une categorie</option>
                    <option>Cake</option>
                    <option>SpaceCake</option>
                    <option>Sweets</option>
                    <option>Lolipop</option>
                </select>
            </div><br>

            <!--Tag-->
            <!--  <div> -->
            <label for="">Tags</label><br />
            <select name="idTag" id="">
                <option value="">Choisir un Tag</option>
                <option>Jelly</option>
                <option>Fudge</option>
                <option>Sugar</option>
                <option>Fruits</option>
            </select><br>
            <!-- </div>  -->


            </form>
        </div>
    </div>
</body>

</html>