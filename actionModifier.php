<?php
/**
 * Created by PhpStorm.
 * User: hayfa
 * Date: 15/04/2018
 * Time: 18:19
 */

try {
    $bdd = new PDO('mysql:host=localhost;dbname=hopital', 'root', '');
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}
if (isset($_POST['ok'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $daten = $_POST['dn'];
    $dates = $_POST['ds'];
    $departement = $_POST['dep'];
    $antec = $_POST['antecedents'];

    $chambre=$_GET['chambre'];
    $mon_id = $_POST['id'];

    if($departement!=$_GET['depart']){
        $sql = "select * from chambre where occupee=0 and departement=" . $departement . "  ";
        $rep = $bdd->query($sql);
        $donnee = $rep->fetch();

        if ($donnee == false) {
            echo "Il n'y a pas de chambre disponible dans ce département\n";
        } else {
            $nv_chambre = $donnee['numero'];

            $req1 = $bdd->prepare('UPDATE chambre SET occupee = :val WHERE numero = :num');
            $req1->execute(array(
                'num' => $nv_chambre,
                'val' => 1,
            ));
            $req2 = $bdd->prepare('UPDATE chambre SET occupee = :val WHERE numero = :num');
            $req2->execute(array(
                'num' => $chambre,
                'val' => 0,
            ));
            $req3 = $bdd->prepare('UPDATE patient SET chambre = :val1 WHERE id = :val2');
            $req3->execute(array(
                'val1' => $nv_chambre,
                'val2' => $mon_id,
            ));

            echo "affectation chambre réussie";
        }
    } else { echo "département non changé";}

    $req = $bdd->prepare("UPDATE patient SET nom = :val1, prenom = :val2, date_naissance = :val3, date_sortie = :val4, 
                      departement = :val5, antecedents_medicaux = :val6 WHERE id= $mon_id ");

    $req->execute(array('val1' => $nom,
        'val2' => $prenom,
        'val3' => $daten,
        'val4' => $dates,
        'val5' => $departement,
        'val6' => $antec ));


}
?>
<script type="text/javascript">
    prompt("modification effectuée avec succès")
</script><?php
header('Location: indexPatient.php');
?>






