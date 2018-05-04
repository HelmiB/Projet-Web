<?php
try{
    $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
}
catch (PDOException$e) { print"Erreur : " . $e->getMessage(); die(); }
$bdd2->query("USE hopital");
$req=$bdd2->prepare('delete From receptionniste WHERE id_receptionniste=?');
$req->execute(array($_GET["id"]));
header('Location: admin.php');
?>
