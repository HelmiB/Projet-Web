<?php
/**
 * Created by PhpStorm.
 * User: hayfa
 * Date: 29/04/2018
 * Time: 17:42
 */


    try {
        $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
    }
    catch (PDOException $e)
    {
        echo "erreur";
        die();
    }
    $id_patient=$_GET['id'];

    //Récuperer les donnees format requete
    $sql = "select * from visite where patient=".$id_patient."";
    try
    {
        $rep =$bdd->query($sql); //effectuer la requete resultat ss forme d'objet sql inexploitable
    }catch(Exception $e){
        die('Erreur');
    }
if($rep){
    while ($visite = $rep->fetch())
    {
        ?>
        <tr>

            <td><?php echo $visite['numero'] ?></td>
            <td><?php echo $visite['type'] ?></td>
            <td><?php echo $visite['date'] ?></td>
            <td><?php echo $visite['taille'] ?></td>
            <td><?php echo $visite['poids'] ?></td>
            <td><?php echo $visite['diagnostique'] ?></td>
            <td><?php echo $visite['docteur'] ?></td>
            <td><?php echo $visite['departement'] ?></td>

        </tr>

        <?php
    }
    $rep->closeCursor();

}