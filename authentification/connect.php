<?php 
session_start();
try{
$bdd = new PDO('mysql:host=localhost;dbName=hopital', 'root', '');
}

catch (PDOException $e)
{
print "Erreur : " . $e->getMessage();
die();
}
if($_POST['user']=="admin"){
$user=$_POST['user'];
$psswd=$_POST['psswd'];
$bdd->query("USE hopital");
echo $user;
$rep = $bdd->prepare("SELECT * FROM admin WHERE user='".$user."'") ;
$rep->execute();
$result = $rep->fetch(PDO::FETCH_NUM);
var_dump($result);
     $message="?message=connection reussite";
	 if (count($result)==1){
     $message="?message=user invalide";
}
else{
	if ($result[1]!=$psswd) 
	  $message="?message=mot de passe invalide";
	
	else {
		$_SESSION['user']=$user;
		
	}
}
header("Refresh:0; url=authentification.php".$message);}
else{
	$user=$_POST['user'];
$psswd=$_POST['psswd'];
$bdd->query("USE hopital");
echo $user;
$rep = $bdd->prepare("SELECT * FROM receptionniste WHERE user='".$user."'") ;
$rep->execute();
$result = $rep->fetch(PDO::FETCH_NUM);
var_dump($result);
     $message="?message=connection reussite";
	 if (count($result)==1){
     $message="?message=user invalide";
}
else{
	if ($result[7]!=$psswd) 
	  $message="?message=mot de passe invalide";
	
	else {
		$_SESSION['user']=$user;
		
	}
}
header("Refresh:0; url=authentification.php".$message);
}

?>