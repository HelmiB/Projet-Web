
<?php
try{
    $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
}
catch (PDOException$e) { print"Erreur : " . $e->getMessage(); die(); }
$bdd2->query("USE hopital");
$req=$bdd2->prepare('delete From medecin WHERE id=?');
$req->execute(array($_GET["id"]));
header('Location: medecin.php');
?>