
<?php
try{
    $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
}
catch (PDOException$e) { print"Erreur : " . $e->getMessage(); die(); }
$bdd2->query("USE hopital");
$req= $bdd2->prepare('insert into medecin(`nom` , `prenom`, `telephone`,`departement`) values (:val2,:val3,:val4,:val5)');
$req->execute(array('val2'=>$_POST["doctname"],'val3'=>$_POST["doctlastname"], 'val4'=>$_POST["phon"],'val5'=>$_POST["dept"]));
header('Location: medecin.php');
?>