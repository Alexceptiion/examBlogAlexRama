<?php
require "connect.php";
require "helpers.php";

if(!existGET("id")){
    redirectTo("formulaire.php");
}
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

//Vérifier et obtenir la ligne de base de données
// $stmt = $db->prepare("SELECT * FROM blog WHERE id=idArticle");

// $article = null;
// if($stmt->execute([$id])){
//     $article = $stmt->fetch();
// }else{
//     $errors[] = "C'est vachement pas sympas SUR 20";
// }



// Reception du formulaire modify
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["idArticle"])){
        $statusArticle = 'Publié';

        $stmt = $db->prepare("
        UPDATE article SET 
        titreArticle = :titreArticle, 
        contenuArticle = :contenuArticle, 
        statutArticle = :statutArticle 
        WHERE idArticle = :idArticle;
        ");
        $res = $stmt->execute([
            ':titreArticle' => htmlspecialchars($_POST["titreArticle"]), 
            ':contenuArticle' => htmlspecialchars($_POST["contenuArticle"]), 
            ':statutArticle' => $statusArticle, 
            ':idArticle' => htmlspecialchars($_POST["idArticle"])
         ]);
        
    }
    header("Location: ./index.php");
}


// // On verifie que la methode post existe, si elle existe on execute la requete
//  if($_SERVER["REQUEST_METHOD"] === "POST"){
//      if(existPOST("titreArticle")){

        
//         $res = $stmt->execute([
//            ":titreArticle" => htmlspecialchars($_POST["titreArticle"])
//            //":contenuArticle" => htmlspecialchars($_POST["contenuArticle"]),
//            //"dateCreationArticle" => $_POST["dateCreationArticle"],
//            //"statutArticle" => htmlspecialchars($_POST["statutArticle"]),
//            //":idCategorie" => htmlspecialchars($_POST["idCategorie"]),
//            //':idTag' => htmlspecialchars($_POST["idTag"])
//         ]);

//     // on verifie si la reponse est vrai ou fausse
//     //     if ($res=== true){
//              redirectTo("index.php");
//     //     }else{
//     //         $errors[] = "Erreur lors de la sauvegarde des données. Veuillez réessayer plus tard";
//     //     }
//         }else{
//             $errors[] = "Veuillez remplir tous les champs";
//         }
//     }
foreach($errors as $error){ ?>
<div class="alert alert-warning">
    <?= $error ?>
</div>
<?php }
?>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
</head>

<body>

    <!---------------------------------------->
    <div class="justify-content-center">
        <div class="container">
            <h1 class="text-left">Modifier l'article</h1>
        </div>

        <div>
            <form method=" POST">
                <!--titre article-->
                <div class="d-flex justify-content-center">
                    <div class="col-8 me-3">
                        <div class="mb-3">
                            <!-- <label type="hidden" name="idArticle" value="<?= $valueIdArticle; ?>">
                        </label>
                        <input type="text" placeholder="Titre de l'article" name="titreArticle"
                            value="<?= $valueTitre; ?>"> -->
                            <input class="form-control" type="text" value="<?= $valueTitre; ?>"
                                aria-label="default input example">
                        </div>
                        <!--Contenu-->
                        <div>
                            <textarea class="form-control" name=" contenuArticle" placeholder="Contenu" id="" cols="30"
                                rows="20"><?= $valueArea; ?></textarea>
                        </div>
                    </div>
                    <div class=" deuxiemepartie">
                        <div>
                            <label for="">Categorie</label><br />
                            <select name="idCategorie" id="">
                                <option value="">Choisir une categorie</option>
                                <option>Cake</option>
                                <option>SpaceCake</option>
                                <option>Sweets</option>
                                <option>Lolipop</option>
                            </select>
                        </div><br>

                        <!--Tag-->
                        <div>
                            <label for="">Tags</label><br />
                            <select name="idTag" id="">
                                <option value="">Choisir un Tag</option>
                                <option>Jelly</option>
                                <option>Fudge</option>
                                <option>Sugar</option>
                                <option>Fruits</option>
                            </select>
                        </div><br>

                        <div class="card d-flex">
                            <button type="submit" class="btn btn-outline-info"
                                id="publierbtn">Publier</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-outline-success"
                                id="sauvegarderbtn">Sauvegarder</button>&nbsp;&nbsp;
                            <a class="btn btn-outline-danger" href="delete.php?id=<?= $valueIdArticle ?>"
                                id="supprimerbtn">Supprimer</a>&nbsp;&nbsp;
                        </div>
                    </div>
                </div>

                <!--categorie-->



            </form>
        </div>
    </div>
</body>

</html>