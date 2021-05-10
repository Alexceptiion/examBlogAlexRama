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
        <h1>Modifier l'article</i></h1>
        <?php foreach($errors as $error){ ?>
            <div class="alert alert-warning">
                <?= $error ?>
            </div>
        <?php } ?>
        <div class="card p-4 w-50">
            <form method="POST">
            <!--titre article-->
                <div class="mb">
                    <input type="text" placeholder="Titre de l'article" name="titreArticle" value="<?= $valueTitre; ?>">   
                    <input type="hidden" name="idArticle" value="<?= $valueIdArticle; ?>">
                </div>
                <!--Contenu-->
                <div>
                    <textarea name="contenuArticle" placeholder="Contenu" id="" cols="30" rows="10"><?= $valueArea; ?></textarea>
                </div>

                <!--categorie-->
            <div deuxiemepartie>  
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
                <button type="submit" class="mt-3 btn btn-primary" id="publierbtn">Publier</button>
                <button type="submit" class="mt-3 btn btn-primary" id="sauvegarderbtn">Sauvegarder</button>
                <a class="btn btn-success active" href="delete.php?id=<?= $valueIdArticle ?>" id="supprimerbtn">Supprimer</a>
               </div>
            </div>      

            </form>
        </div>
    </div>
</body>
</html>
