<?php
try{
    $bdd2= new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
}
catch (PDOException$e) { print"Erreur : " . $e->getMessage(); die(); }
$bdd2->query("USE hopital");
echo $_POST["name"];
$req= $bdd2->prepare('insert into receptionniste(`nom` , `prenom`, `sexe`,`date_naissance`,`date_debuttravail`,`user`,`pass`) values (:val2,:val3,:val4,:val5,:val6,:val7,:val8)');
$req->execute(array('val2'=>$_POST["name"],
	'val3'=>$_POST["lastname"],
	'val4'=>$_POST["sexe"],
	'val5'=>$_POST["Dn"],
	'val6'=>$_POST["Dt"],
	'val7'=>$_POST["username"],
	'val8'=>$_POST["password"]));
header('Location: admin.php');
?>
