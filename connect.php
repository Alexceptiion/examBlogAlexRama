<!--Connexion a la BDD-->
<?php
try{
    $db = new PDO("mysql:host=localhost;charset=UTF8;dbname=blog", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $err){
    echo "Impossible d'initialiser une connection avec la base de données. Veuillez réésayer plus tard";
    die;
}