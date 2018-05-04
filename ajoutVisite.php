<?php
/**
 * Created by PhpStorm.
 * User: hayfa
 * Date: 22/04/2018
 * Time: 20:26
 */
    try {
        $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
    }
    catch (PDOException $e)
    {
        echo "erreur";
        die();
    }


    if (isset($_POST['ok'])) {

        $req = $bdd->prepare("insert into visite (`patient`,`type`,`date`,`taille`,`poids`,`diagnostique`,`docteur`,`departement`)
           
                                                  VALUES (:val1,:val2,:val3,:val4,:val5,:val6,:val7,:val8)");
        $req->execute(array(
            'val1' => $_GET['id'],
            'val2' => $_POST['type'],
            'val3' => $_POST['date'],
            'val4' => $_POST['taille'],
            'val5' => $_POST['poids'],
            'val6' => $_POST['diag'],
            'val7' => $_POST['doc'],
            'val8' => $_GET['dep'],
        ));
    }
header('Location: Fiche.php?id='. $_GET['id'] .' ');


