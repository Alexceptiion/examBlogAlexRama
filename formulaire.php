<?php
require "connect.php";
require "helpers.php";

$errors = [];

// On verifie que la methode post existe, si elle existe on execute la requete
 if($_SERVER["REQUEST_METHOD"] === "POST"){
     if(existPOST("titreArticle")){
        $sql = "INSERT INTO `article` 
        (titreArticle, dateCreationArticle, statutArticle, contenuArticle) 
        VALUES (:titreArticle, CURDATE(), 'Publié', 'area')";

        $stmt = $db->prepare($sql);
        $res = $stmt->execute([
           ":titreArticle" => htmlspecialchars($_POST["titreArticle"])
           //":contenuArticle" => htmlspecialchars($_POST["contenuArticle"]),
           //"dateCreationArticle" => $_POST["dateCreationArticle"],
           //"statutArticle" => htmlspecialchars($_POST["statutArticle"]),
           //":idCategorie" => htmlspecialchars($_POST["idCategorie"]),
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            <form method="POST" class="leformulaire">
            <!--titre article-->
                <div class="mb">
                    <input type="text" placeholder="Titre de l'article" name="titreArticle">   
                </div>
                <!--Contenu-->
                <div>
                    <textarea name="contenuArticle" id="" cols="30" rows="10"></textarea>
                </div>

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
               
               <div class="btnform">
                <button type="submit" class="btn btn-outline-info" id="btnpublier">Publier</button>
                <button type="submit" class="btn btn-outline-warning" id=btnsauvegarder>Sauvegarder</button>
               </div> 

            </form>
        </div>
    </div>
</body>
</html>