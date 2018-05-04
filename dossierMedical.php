<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="img/logo.png" rel="icon"/>
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
            <li ><a href="departement.php">&nbsp Départements</a></li>
            <li><a href="chambre.php">&nbsp Lits</a></li>
        </ul>
    </div>
    <!----- fin Menu ------>

    <!-----------  Début Contenu ------------>
    <div class="col-md-10 contenu">
       <br>
        <div>
        <form class="navbar-form pull-right">
            <a  href="indexPatient.php" class="btn btn-primary">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Tous les patients
            </a>
        </form>
            <br>
        </div>
        <br><br>
        <div class="panel panel-info contentinside">
            <!----------------   Panel Head   --------------->
            <div class="panel-heading">
                <strong>Dossier médical n° <?php echo $_GET['id']; ?></strong>
            </div>
            <!----------------   Panel Body Start   --------------->
            <div class="panel-body">
                <div class="row" >

    <?php
        try {
            $bdd= new PDO('mysql:host=localhost;dbname=hopital', 'root','');
        }
        catch (PDOException $e)
        {
        echo "erreur";
        die();
        }
        $id_personne=$_GET['id'];

        //Récuperer les donnees format requete
        $sql = "select * from patient where id=".$id_personne."";
        try
        {
        $rep =$bdd->query($sql); //effectuer la requete resultat ss forme d'objet sql inexploitable
        }catch(Exception $e){
        die('Erreur');
        }
        $donnee = $rep->fetch();
    ?>

                    <section class="col-sm-4 table-responsive">
                        <table class="table table-bordered table-striped table-condensed">
                            <tr>
                                <th>Nom</th>
                                <td><?php echo $donnee['nom']?></td>
                            </tr>
                            <tr>
                                <th>Prenom</th>
                                <td><?php echo $donnee['prenom']?></td>
                            </tr>
                            <tr>
                                <th>Sexe</th>
                                <td><?php echo $donnee['sexe']?></td>
                            </tr>
                            <tr>
                                <th>Date de naissance</th>
                                <td><?php echo $donnee['date_naissance']?></td>
                            </tr>
                            <tr>
                                <th>Date d'hospitalisation</th>
                                <td><?php echo $donnee['date_hospitalisation']?></td>
                            </tr>
                            <th>Date de sortie</th>
                            <td><?php echo $donnee['date_sortie']?></td>
                            </tr>
                            <tr>
                                <th>Numero de Chambre</th>
                                <td><?php echo $donnee['chambre']?></td>
                            </tr>
                            <tr>
                                <th>Departement</th>
                                <td><?php echo $donnee['departement']?></td>
                            </tr>
                            <tr>
                                <th>Antécédents Médicaux</th>
                                <td><?php echo $donnee['antecedents_medicaux']?></td>
                            </tr>
                        </table>
                    </section>
                </div>
            </div>

            <!----------------   Historique Visites commence ici   --------------->
            <div class="panel-heading"><strong>Historique des visites</strong></div>

            <div class="panel-body" id="visite">


                <div>
                <table class="table table-bordered table-hover" >

                    <tr class="active ">
                        <th >Numéro Viste </th>
                        <th >Type </th>
                        <th >Date </th>
                        <th >Taille </th>
                        <th >Poids </th>
                        <th >Diagnostique </th>
                        <th >Docteur </th>
                        <th >Département</th>
                    </tr>

                    <?php include('AffichageVisite.php')?>

                </table>
            </div>
            <!----------------   fin Tableau   --------------->