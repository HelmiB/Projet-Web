<?php
    try {
        $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
    }catch (PDOException $e){die('Erreur');}

    //Récuperer les donnees format requete
    $req = "select * from patient";
    try {
    $rep =$bdd->query($req);
    }catch(Exception $e){die('Erreur');}

    while ($donnees = $rep->fetch())
    {
        if($donnees['date_sortie'] != '0000-00-00') {
            ?>
            <tr>
                <td><?php echo $donnees['id'] ?></td>
                <td><?php echo $donnees['nom'] ?></td>
                <td><?php echo $donnees['prenom'] ?></td>
                <td><?php echo $donnees['date_hospitalisation'] ?></td>
                <td><?php echo $donnees['date_sortie'] ?></td>
                <td><?php echo $donnees['chambre'] ?></td>
                <td><?php echo $donnees['departement'] ?></td>
                <td align="center">
                    <a  href="<?php echo "dossierMedical.php?id=" . $donnees['id'] ." "?>" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
                </td>
            </tr>
            <?php
        }
    }
    $rep->closeCursor();
?>