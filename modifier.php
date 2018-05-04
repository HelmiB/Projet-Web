<?php
/**
 * Created by PhpStorm.
 * User: hayfa
 * Date: 15/04/2018
 * Time: 17:07
 */

try{
    $bdd= new PDO('mysql:host=localhost;dbname=hopital','root','');
} catch(PDOException $e){
    die('Erreur : '.$e->getMessage());
}


$req = $bdd->prepare('SELECT * FROM patient WHERE id = ?');
$req->execute(array($_GET['id']));

$personne = $req->fetch();

?>
<!DOCTYPE html>
<html>
<head>
    <link href="img/logo.png" rel="icon"/>
    <meta charset="utf-8">
    <title> Système Gestion hôpital</title>
    <link href="css/styles.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>

</head>

<body>
<!--- début header --------->
<div class="row " style="background-color:rgb(51,122,183)">
    <nav class="navbar navbar-expand-sm  navbar-dark ">
        <div class="col-md-10 container-fluid">
            <div class="navbar-header">
                <h2 style="color: white"> &nbsp;&nbsp; Gestion de l'hopital </h2>
            </div>
        </div>
        <div class="col-md-2 ">
            <ul class="nav navbar-nav navbar-right">
                <li>
                <li ><a href="deconnexion.php" class="deconnexion"><span class="glyphicon glyphicon-log-out" aria-hidden="true" ></span> &nbsp; Déconnexion</a></li>
                </li>
            </ul>
        </div>
    </nav>
</div>
<!--- fin header --------->

<!----- début Menu ------>
<div class="row" >

    <div class="col-md-2 sidenav height:700x;" >
        <h1></h1>
        <ul class="nav nav-pills nav-stacked ">
            <li class="active"><a href="indexPatient.php">&nbsp Patients </a></li>
            <li><a href="medecin.php">&nbsp Docteurs</a></li>
            <li><a href="departement.php">&nbsp Départements</a></li>
            <li><a href="chambre.php">&nbsp Chambres</a></li>
        </ul>
    </div>
    <!----- fin Menu ------>

    <!-----------  Début Contenu ------------>
    <div class="col-md-10 contenu">
        <br> <br>

        <div class="panel panel-info contentinside">
            <!----------------   Panel Head   --------------->
            <div class="panel-heading"><strong>Gestion des patients</strong></div>
            <!----------------   Panel Body Start   --------------->
            <div class="panel-body">
                <!----------------   Affichage Tableau commence ici   --------------->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="actionModifier.php?chambre=<?php echo $personne['chambre'];?>&depart=<?php echo $personne['departement'];?>">
                            <input type="hidden" name="id" value="<?php echo "".$personne['id']. ""?>">

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Nom</label>
                                <div class="col-sm-4">
                                    <input name="nom" id="nom" class="form-control" type="text" value="<?php echo $personne['nom']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Prénom</label>
                                <div class="col-sm-4">
                                    <input name="prenom" id="prenom" class="form-control" type="text" value="<?php echo $personne['prenom']; ?>"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-4 control-label">Sexe</label>
                                <div class="col-sm-4">
                                    <input name="sexe" id="sexe" class="form-control" type="text" value="<?php echo $personne['sexe']; ?>" disabled="disabled"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Date de naissance</label>
                                <div class="col-sm-4">
                                    <input name="dn" id="dn" class="form-control" type="date" value="<?php echo $personne['date_naissance']; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Date d'admission</label>
                                <div class="col-sm-4">
                                    <input name="dh" id="dh" class="form-control" type="date" value="<?php echo $personne['date_hospitalisation'];?>" disabled="disabled">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Date de sortie</label>
                                <div class="col-sm-4">
                                    <input name="ds" id="ds" class="form-control" type="date" placeholder="date de sortie">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Numéro Chambre</label>
                                <div class="col-sm-4">
                                    <input name="chambre" class="form-control" id="chambre" type="number" value="<?php echo $personne['chambre'];?>" disabled="disabled">
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Départment</label>
                                <div class="col-sm-4">
                                    <input name="dep" id="dep" class="form-control" type="number" value="<?php echo $personne['departement']; ?>"/></td>
                                </div>
                            </div>

                            <div class="form-group">
                                <label  class="col-sm-4 control-label">Antécédents médicaux</label>
                                <div class="col-sm-4">
                                    <textarea id="antecedents" class="form-control" name="antecedents"><?php echo $personne['antecedents_medicaux']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" name="ok" class="btn btn-primary">Enregistrer</button>
                                    <button href="indexPatient.php" class="btn btn ">Retour</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <!----------------   fin Tableau   --------------->
            </div>
            <!----------------   fin Panel   --------------->

        </div>

    </div>

</div>
<!-------   fin Contenu --------->

