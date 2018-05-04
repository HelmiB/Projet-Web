<?php
try {
    $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
}
catch (PDOException $e)
{
    echo "erreur";
    die();
}
//Ajout de Patient
if (isset($_POST['ok'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $id = $_POST['cin'];
    $sexe = $_POST['sexe'];
    $daten = $_POST['dn'];
    $dateh = $_POST['dh'];
    $num = $_POST['num'];
    $num_dep = $_POST['dep'];
    $sql = "select * from chambre where occupee=0 and departement = ".$num_dep." ";
    try {
        $rep = $bdd->query($sql);
    } catch (Exception $e) {
        die('Erreur');
    }
    $donnee = $rep->fetch();
    if ($donnee == false) {
        echo "Il n'y a pas de chambre disponible dans ce département";
    } else {
        $chambre = $donnee['numero'];
        $reqp = $bdd->prepare('UPDATE chambre SET occupee = :val WHERE numero = :num');
        $reqp->execute(array(
            'num' => $chambre,
            'val' => 1,
        ));
        $antecedent = $_POST['antecedents'];
        $req = $bdd->prepare("insert into patient (`id`,`nom`,`prenom`,`sexe`,`date_naissance`,`numero`,`date_hospitalisation`,`chambre`,`departement`,`antecedents_medicaux`)
                                                         VALUES (:val1,:val2,:val3,:val4,:val5,:val6,:val7,:val8,:val9,:val10)");
        $req->execute(array('val1' => $id,
            'val2' => $nom,
            'val3' => $prenom,
            'val4' => $sexe,
            'val5' => $daten,
            'val6' => $num,
            'val7' => $dateh,
            'val8' => $chambre,
            'val9' => $num_dep,
            'val10' => $antecedent,
        ));
        
        echo "Le patient a bien été ajouté, il est affecté a la chambre n : ";
        echo $chambre;
    }}
header('Location: indexPatient.php');
?>